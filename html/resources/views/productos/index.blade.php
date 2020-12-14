<?php
use App\Models\carrito;
use App\Models\carrito_detalle;
use Illuminate\Support\Facades\Auth;
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
                            @if ($producto->disponibilidad=='0')
                                <p class="card-text font-weight-bold">Sin Stock</p>
                            @else
                                <p class="card-text">Disponibles: {{$producto->disponibilidad}}</p>
                            @endif
                            <p class="card-text">{{$producto->descripcion}}</p>
                            @guest
                            <a class="btn btn-success btn-sm disabled">
                                Agregar al carrito
                            </a>
                            @else
                                @if ($producto->disponibilidad=='0')
                                    <a class="btn btn-success btn-sm disabled">
                                        Agregar al carrito
                                    </a>
                                @else
                                    <?php
                                    $user = Auth::user();
                                    $contador=0;
                                    $datos = carrito::where('usuario_id', $user->id)->where('estado', 'A')->first();
                                    if (!$datos == null) {
                                        $detalleCarrito= carrito_detalle::where('carrito_id', $datos->id)
                                                                        ->where('producto_id', $producto->id)->first();
                                    }
                                    ?>
                                    @if ($detalleCarrito == null)
                                        <a href="{{ url('carrito-addCart/'.$producto->id)}}" class="btn btn-success btn-sm">
                                            Agregar al carrito
                                        </a>
                                    @else
                                        <a class="btn btn-warning btn-sm disabled">
                                            Agregado al carrito
                                        </a>
                                    @endif
                                @endif
                                <!--<a class="btn btn-warning" href="{{ url('/productos/'.$producto->id.'/edit') }}">
                                    Editar
                                </a>-->
                            @endguest
                        </div>
                    </div>
                </div>
                @endforeach
        </div>{{ $productos->links() }}
    </div>

</div>
@endsection
