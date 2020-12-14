<?php
use App\Models\carrito_detalle;
use App\Models\producto;
$detalleP = carrito_detalle::all();
//$listadoProductos = producto::all();
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
            <?php
                $listadoProductos = producto::where('id',$detalle->producto_id)->first();
            ?>
            <tr>
                @if (($detalle->carrito_id) == ($producto->id))
                     <?php
                        $precioTotal = $precioTotal + $detalle->precio*$detalle->cantidad;
                     ?>
                    <td>
                        <img src="{{ asset('storage/uploads').'/'.$listadoProductos->imagen}}" alt="" class="img-thumbnail img-fluid" width="100">
                    </td>
                    <td>{{$listadoProductos->nombre}}</td>
                    <td>{{$detalle->cantidad}}</td>
                    <td>$ {{$detalle->precio}}</td>
                    <td>$ {{$detalle->precio*$detalle->cantidad}}</td>
                    <td>
                        @if ($listadoProductos->disponibilidad > $detalle->cantidad)
                            <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                                {{ @csrf_field() }}
                                {{ @method_field('PATCH')}} <!-- esta linea modifica un producto al detalle de compra -->
                                <input type="hidden" name="cantidad" id="cantidad" value="1">
                                <button class="btn btn-success" type="submit">+</button>
                            </form>
                        @else
                            <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                                {{ @csrf_field() }}
                                {{ @method_field('PATCH')}} <!-- esta linea modifica un producto al detalle de compra -->
                                <input type="hidden" name="cantidad" id="cantidad" value="1">
                                <button class="btn btn-success" type="submit" disabled>+</button>
                            </form>
                        @endif

                        @if ($detalle->cantidad > 1 )
                            <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                                {{ @csrf_field() }}
                                {{ @method_field('PATCH')}} <!-- esta linea modifica un producto al detalle de compra -->
                                <input type="hidden" name="cantidad" id="cantidad" value="-1">
                                <button class="btn btn-warning" type="submit">-</button>
                            </form>
                        @else
                            <form method="post" action="{{ url('/carritosDetalle/'.$detalle->id) }}" style="display:inline">
                                {{ @csrf_field() }}
                                {{ @method_field('PATCH')}} <!-- esta linea modifica un producto al detalle de compra -->
                                <input type="hidden" name="cantidad" id="cantidad" value="-1">
                                <button class="btn btn-warning" type="submit" disabled>-</button>
                            </form>
                        @endif
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
