<?php

namespace App\Http\Controllers;

use App\Models\rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$datos['rubro']=rubro::paginate(5); //['rubro'] indice de la variable datos
        return view('productos/rubros.index');
        //toda la info q recupero del modelo rubro,
        //se pasa a la vista index mediante la variable $datos
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos/rubros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$datosRubros=request()->all(); esta linea hace q se almacene todo lo q trae la variable request.
        $datosRubros=request()->except('_token');
        rubro::insert($datosRubros); // rubro->hace referencia al modelo.
        return response()->json($datosRubros); //retorna una respuesta json
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function show(rubro $rubro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function edit(rubro $rubro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rubro $rubro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rubro  $rubro
     * @return \Illuminate\Http\Response
     */
    public function destroy(rubro $rubro)
    {
        //
    }
}
