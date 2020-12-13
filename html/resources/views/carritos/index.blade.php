@extends('layouts.app')
@section('title')
    Carrito de Compras
@endsection
@section('content')
<?php
use App\Models\carrito_detalle;
//$importeTotal=0;
$detalleP = carrito_detalle::all();

?>
<div class="container">
    <h2>Carrito de compra</h1>
        <table class="table table-light">
            <thead class="thead-light">
                @forelse ($productos as $producto)
                    <tr>
                        <th>Precio Total</th>
                        <th>$ {{$producto->precio}}</th>
                        <th>
                            <a class="btn btn-success" href="{{ url('confirmarcompra/'.$producto->carrito_id)}}">
                                Confirmar compra
                            </a>
                        </th>
                    </tr>
                    @empty
                @endforelse
            </thead>
        </table>
    <table class="table table-hover">
        <thead>
            <th>#</th>
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

                    <td>{{$loop->iteration}}</td>
                    <td></td>
                    <td>{{$detalle->producto_id}}</td>
                    <td>{{$detalle->cantidad}}</td>
                    <td>$ {{$detalle->precio}}</td>
                    <td>$ {{$detalle->precio*$detalle->cantidad}}</td>
                    <td>
                        <a class="btn btn-success" href="{{ url('/productos/'.$producto->id.'/edit') }}">
                        +
                        </a>
                        <a class="btn btn-warning" href="{{ url('/productos/'.$producto->id.'/edit') }}">
                            -
                        </a>
                        <a class="btn btn-danger" href="{{ url('/productos/'.$producto->id.'/edit') }}">
                            x
                         </a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
