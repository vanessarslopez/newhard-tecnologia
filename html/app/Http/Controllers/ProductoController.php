<?php

namespace App\Http\Controllers;

use App\Models\producto;
use App\Models\rubro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\carrito;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datos['productos']=producto::all();
        $datos['productos']=producto::paginate(8);
        return view('productos.index', $datos);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rubros = rubro::all();
        return view('productos.create', compact('rubros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'rubro_id'=> 'required',
            'SKU'=> 'required',
            'nombre'=> 'required|string|max:250',
            'descripcion'=> 'required',
            /*'imagen'=> 'required|max:10000|mimes:jpeg,png,jpg',*/
            'precio'=> 'required',
            'disponibilidad'=> 'required'
        ];
        $mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$mensaje);

        //$datosProductos=request()->all();
        $datosProductos=request()->except('_token');
        if($request->hasFile('imagen')){
            $datosProductos['imagen']=$request->file('imagen')->store('uploads','public');
        }
        producto::insert($datosProductos); // producto->hace referencia al modelo.
        return response()->json($datosProductos);
        //return view('productos.index', $request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rubros = rubro::all();
        $producto=producto::findOrfail($id);
        return view('productos.edit', compact('rubros', 'producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, $id)
    {
        $campos=[
            'rubro_id'=> 'required',
            'SKU'=> 'required',
            'nombre'=> 'required|string|max:250',
            'descripcion'=> 'required',
            'precio'=> 'required',
            'disponibilidad'=> 'required'
        ];
        /*if($request->hasFile('imagen')){
            $campos+=['imagen'=> 'required|max:10000|mimes:jpeg,png,jpg'];
        }*/
        $mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$mensaje);

        $datosProductos=request()->except(['_token','_method']);
        producto::where('id','=',$id)->update($datosProductos);
        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        producto::destroy($id);
        return redirect('productos');
    }

}
