<?php

namespace App\Http\Controllers;

use App\Models\carrito_detalle;
use App\Models\Producto;
use App\Models\Carrito;
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
        //
        $datos['productos'] = carrito_detalle::leftJoin('productos', 'productos.id', '=', 'carritoDetalles.producto_id')
                                            ->paginate(0);

        //->select('CarritosDetalle.*', 'Productos.nombre as producto')
        //Producto::paginate(5);

        //dd($datos);

       return view('carritos.index', $datos);
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
    public function update(Request $request, carrito_detalle $carritoDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarritoDetalle  $carritoDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(carrito_detalle $carritoDetalle)
    {
        //
    }
}
