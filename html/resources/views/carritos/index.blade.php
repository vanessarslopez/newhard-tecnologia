@extends('layouts.app')

@section('content')
{{ $importeTotal=0 }}


<div class="container">
    <h2>Lista de Productos</h1>
</div>

<div class="container">
    <table class="table table-light table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>imagen</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
    <tbody>
    @forelse ($productos as $producto)
        {{ $importeTotal = $importeTotal+ $producto->precio * $producto->cantidad }}
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>
            <img src="{{ asset('storage/uploads').'/'.$producto->imagen}}" alt="" class="img-thumbnail img-fluid" width="100">
        </td>
        <td>{{$producto->nombre}}</td>
        <td>{{$producto->cantidad}}</td>
        <td>{{$producto->precio}}</td>
        <td>
            <a class="btn btn-success" href="#">
                +
                </a>
                <a class="btn btn-warning" href="#">
                    -
                    </a>
            <form method="post" action="{{ url('/productos/'.$producto->id) }}" style="display:inline">
                {{ @csrf_field() }}
                {{ @method_field('DELETE') }} <!-- esta linea borra el registro -->
                <button class="btn btn-danger" type="submit" onclick="return confirm('¿Borrar?');">X</button>
            </form>
        </td>
    </tr>
    @empty

    @endforelse
    </tbody>
    </table>
    <div>Total: {{ $importeTotal}}

    </div>
</div>

@endsection
