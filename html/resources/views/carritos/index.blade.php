<?php
use App\Models\carrito_detalle;
use App\Models\producto;
$detalleP = carrito_detalle::all();
$listadoProductos = producto::all();
$precioTotal= 0;
?>
@extends('layouts.app')
@section('title')
    Carrito de Compras
@endsection
@section('content')

<div class="container">
    <h2>Carrito de Compras</h1>
        <table class="table table-light">
            <thead class="thead-light">
                @forelse ($productos as $producto)
                    @empty
                @endforelse
            </thead>
        </table>
    <table class="table table-hover">
        <thead>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Precio Neto</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($detalleP as $detalle)
            <tr>
                @if (($detalle->carrito_id) == ($producto->id))
                     <?php
                     //$precioNeto = $precioNeto + $detalle->precio*$detalle->cantidad
                     $precioTotal = $precioTotal + $detalle->precio * $detalle->cantidad ?>

                    <td>img</td>
                    <td>{{$detalle->producto_id}}</td>
                    <td>{{$detalle->cantidad}}</td>
                    <td>$ {{$detalle->precio}}</td>
                    <td>$ {{$detalle->precio*$detalle->cantidad}}</td>
                    <td>
                        <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                            {{ @csrf_field() }}
                            {{ @method_field('PATCH')}} <!-- esta linea modifica un producto al detalle de compra -->
                            <input type="hidden" name="cantidad" id="cantidad" value="1">
                            <button class="btn btn-success" type="submit">+</button>
                        </form>
                        <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                            {{ @csrf_field() }}
                            {{ @method_field('PATCH')}} <!-- esta linea modifica un producto al detalle de compra -->
                            <input type="hidden" name="cantidad" id="cantidad" value="-1">
                            <button class="btn btn-warning" type="submit">-</button>
                        </form>
                        <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                            {{ @csrf_field() }}
                            {{ @method_field('DELETE') }} <!-- esta linea borra el registro -->
                            <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">X</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <table class="table table-light">
        <thead class="thead-light">
                <tr>
                    <th>Precio Total</th>
                    <th>$ {{$precioTotal}}</th>
                    <th>
                        <form method="GET" action="{{ url('confirmarcompra/'.$producto->id) }}" style="display:inline">
                            {{ @csrf_field() }}
                            {{ @method_field('GET')}} <!-- esta linea modifica un producto al detalle de compra -->
                            <input type="hidden" name="precio" id="precio" value="{{$precioTotal}}">
                            <button class="btn btn-success" type="submit">
                                Confirmar compra
                            </button>
                        </form>
                    </th>
                </tr>
        </thead>
    </table>
</div>
@endsection
