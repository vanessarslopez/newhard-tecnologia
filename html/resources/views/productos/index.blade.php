@extends('layouts.app')
@section('title')
    Listado de Productos
@endsection
@section('content')

<div class="container">
    <p>
        <div class="alert alert-success" role="alert">
            Pantalla de mensaje...
        </div>
        </p>
        <div class="row">
            @foreach ($productos as $producto)
                <div class="col-3">
                    <div class="card"> <!-- este div representa 1 producto -->
                        <img
                            title="Titulo producto"
                            alt="Titulo"
                            class="card-img-top"
                            src="{{ asset('storage/uploads').'/'.$producto->imagen}}"
                            >
                        <div class="card-body">
                            <span>{{$producto->nombre}}</span>
                            <h5 class="card-title">{{$producto->precio}}</h5>
                            @if ($producto->cantidad===0)
                            <p class="card-text font-weight-bold">Sin Stock</p>
                            @else
                            <p class="card-text">Disponibles: {{$producto->disponibilidad}}</p>
                            @endif
                            <p class="card-text">{{$producto->descripcion}}</p>

                            <form action="{{ url('/carritos')}}" method="POST">
                                {{ @csrf_field() }}
                                <input type="hidden" name="id" id="id" value="{{$producto->id}}">
                                <input type="hidden" name="nombre" id="nombre" value="{{$producto->nombre}}">
                                <input type="hidden" name="precio" id="precio" value="{{$producto->precio}}">
                                <input type="hidden" name="cantidad" id="cantidad" value="1">
                                <input class="btn btn-success align-content-center" type="submit" value="Agregar al carrito">


                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
        {{ $productos->links() }}
</div>
@endsection
