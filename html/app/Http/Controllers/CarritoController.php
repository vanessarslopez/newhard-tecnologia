<?php

namespace App\Http\Controllers;

use App\Models\carrito;
use App\Models\producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['carrito']=carrito::all();
        //$producto=producto::find($id->id);
        return view('carritos.index', $datos);
        //return view('carritos.index', compact('producto'));
        //return back()->with('success',"$producto->nombre se agrego al carrito");
    }

   /* public function add(Request $request)
    {

    }*

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProductos=request()->except('_token');
        //session([
          //  'key' => $datosProductos
            //]);
        //return back()->with('success',"$producto->nombre se agrego al carrito");
        //$value = $request->session()->get('key');
        //$request->session()->put('key', 'value');
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function show(carrito $carrito)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function edit(carrito $carrito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, carrito $carrito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\carrito  $carrito
     * @return \Illuminate\Http\Response
     */
    public function destroy(carrito $carrito)
    {
        //
    }
}
