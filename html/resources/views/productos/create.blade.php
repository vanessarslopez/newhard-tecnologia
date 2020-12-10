@extends('layouts.app')

@section('content')

<div class="container">

    @if (count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif

<h5>Nuevo Producto</h5>
    <form action="{{ url('/productos')}}" method="POST" class="form-horizontal" enctype="multipart/form-data>">
        <!--enctype="multipart/form-data>" comando para q la foto se envie por el formulario -->
        {{ @csrf_field() }}

        @include('productos.form', ['Modo'=>'crear'])

    </form>
</div>
@endsection
