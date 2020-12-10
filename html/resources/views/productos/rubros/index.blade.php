Listado de Rubros
<!-- con el comando b-table-header se crea automanticamente la estructura de la tabla. -->

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Rubro</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($rubro as $datos)
        <!--foreach ($collection as $item)
        Collection es el indice de la variable datos definida en rubroCollection-->
        <tr>
            <td>{{$loop->id}}</td>
            <td>{{ $rubro->nombre}}</td>
            <td>Editar | Borrar</td>
        </tr>
    @endforeach
    </tbody>
</table>
