<?php
use App\Models\carrito_detalle;
?>
@extends('layouts.app')
@section('title')
    Listado de Productos
@endsection
@section('content')

<div class="container">
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-3">
                    <div class="card" style="height: 500px; margin:5px;"> <!-- este div representa 1 producto -->
                        <img
                            title="Titulo producto"
                            alt="Titulo"
                            class="card-img-top img-fluid"
                            src="{{ asset('storage/uploads').'/'.$producto->imagen}}"
                            >
                        <div class="card-body">
                            <span>#{{$producto->id}} - {{$producto->nombre}}</span>
                            <h5 class="card-title">{{$producto->precio}}</h5>
                            @if ($producto->cantidad===0)
                            <p class="card-text font-weight-bold">Sin Stock</p>
                            @else
                            <p class="card-text">Disponibles: {{$producto->disponibilidad}}</p>
                            <p class="card-text">{{$producto->descripcion}}</p>
                            @endif
                            @guest
                            <a class="btn btn-success btn-sm disabled" title="Ingrese con su usuario">
                                Agregar al carrito
                            </a>
                            @else
                                <a href="{{ url('carrito-addCart/'.$producto->id)}}" class="btn btn-success btn-sm">
                                    Agregar al carrito
                                </a>
                            @endguest
                        </div>
                    </div>
                </div>
                @endforeach
        </div>{{ $productos->links() }}
    </div>

</div>
@endsection
