<?php

namespace App\Http\Controllers;

use App\Models\carrito_detalle;
use App\Models\producto;
use App\Models\carrito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $datos['productos'] = carrito::where('usuario_id', $user->id)->where('estado', 'A')->get();
        return view('carritos.index', $datos);
        //dd($datos);
        //return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    public function addCart($id)
    {
        $producto = producto::findOrFail($id);
        $user = Auth::user();
        $carritoUsuario = carrito::where('usuario_id', $user->id)->where('estado', 'A')->first();


        if($carritoUsuario == null){
            $carrito = [
                'usuario_id' => $user->id,
                'precio' => 0,
                'estado' => 'A',
            ];

            Carrito::insert($carrito);

            $carritoUsuario = Carrito::where('usuario_id', $user->id)->where('estado', 'A')->first();

        }
        //dd($carritoUsuario);


        $productoCarrito = carrito_detalle::where('carrito_id', $carritoUsuario->id)
                                         ->where('producto_id', $id)
                                         ->first();


        if($productoCarrito == null){

            $carritoDetalle = [
                'carrito_id' => $carritoUsuario->id,
                'producto_id' => $producto->id,
                'cantidad' => 1,
                'precio' => $producto->precio,
            ];

            carrito_detalle::insert($carritoDetalle);
            $carritoUsuario->precio += $producto->precio;
            $carritoUsuario->save();


        }else{

            $productoCarrito->cantidad ++;
            $productoCarrito->save();

            $carritoUsuario->precio += $producto->precio;
            $carritoUsuario->save();

        }

        return back()->with('success',"$producto->nombre ¡se ha agregado con éxito al carrito!");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    ## COMFIRMAR COMPRA
    public function confirmarCompra(Request $request, $id)
    {

        $carrito = carrito::findOrFail($id);
        $carritoDetalle = carrito_detalle::where('carrito_id', $id)->get();
        //return response()->json($carritoDetalle);
        $carrito->estado = "C";
        $carrito->precio = request()->precio;
        $carrito->save();
        foreach ($carritoDetalle as $detalle) {
            $this->actualizarStock($detalle->producto_id, $detalle->cantidad);
        }
        $datos['productos']=producto::paginate(8);
        return view('productos.index', $datos);
        //dd($id);
    }

    public function actualizarStock($id, $cantidad){
        $query = producto::findOrFail($id);
        $stockActual = $query->disponibilidad;
        $stockActual -=$cantidad;
        $query->disponibilidad= $stockActual;
        //llamar update de productocontroller.
        $query->save();
        //producto::where('id','=',$id)->update($query);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarritoDetalle  $carritoDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(carrito_detalle $carritoDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarritoDetalle  $carritoDetalle
     * @return \Illuminate\Http\Response
     */
    public function edit(carrito_detalle $carritoDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarritoDetalle  $carritoDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosProductos = carrito_detalle::findOrFail($id);
        $datosProductos->cantidad +=request()->cantidad;
        $datosProductos->save();
        return redirect('carritosDetalle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarritoDetalle  $carritoDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        carrito_detalle::destroy($id);
        return redirect('carritosDetalle');
    }
}
