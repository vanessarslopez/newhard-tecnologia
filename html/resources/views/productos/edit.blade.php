@extends('layouts.app')

@section('content')

<div class="container">
    <h5>Editar Producto</h5>
    <form action="{{ url('/productos/'.$producto->id) }}" method="POST" enctype="multipart/form-data>">
        <!--enctype="multipart/form-data>" comando para q la foto se envie por el formulario -->
        {{ @csrf_field() }}
        {{ @method_field('PATCH')}}

        @include('productos.form', ['Modo'=>'editar'])

    </form>
</div>
@endsection
