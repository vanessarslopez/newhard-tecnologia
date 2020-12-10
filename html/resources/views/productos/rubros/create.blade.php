Ingresar nuevo rubro
<!-- TENER EN CUENTA:
los INPUT tienen que tener el mismo nombre q la base de datos -->
<form action="{{ url('productos/rubros')}}" method="POST">
    {{ @csrf_field() }}  <!-- tocken de seguridad -->
    <label for="nombre">{{"Rubro"}}</label>
    <input type="text" name="nombre" id="nombre" value="">
    <br/>
    <input type="submit" value="Agregar">
</form>
