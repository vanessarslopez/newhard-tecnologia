<div class="form-group">
    <label for="Rubro" class="control-label">{{"Rubro"}}</label>
    <select name="rubro_id" id="rubro_id" class="form-control {{$errors->has('rubro_id')?'is-invalid':''}}">
        <option value="{{ isset($producto->rubro_id)?$producto->rubro_id:old('rubro_id') }}">
            {{ isset($producto->rubro_id)?$producto->rubro_id:'--Seleccione rubro --' }}
        </option>
        @foreach ($rubros as $rubro)
            <option value="{{ $rubro->id }}">{{ $rubro->nombre }}</option>
        @endforeach
    </select>
    {!! $errors->first('rubro_id','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <label for="SKU" class="control-label">{{"SKU"}}</label>
    <input class="form-control {{$errors->has('SKU')?'is-invalid':''}}" type="text" name="SKU" id="SKU"
    value="{{ isset($producto->SKU)?$producto->SKU:old('SKU') }}"
    >
    {!! $errors->first('SKU','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <label for="Nombre" class="control-label">{{"Nombre"}}</label>
    <input class="form-control {{$errors->has('nombre')?'is-invalid':''}}" type="text" name="nombre" id="nombre"
    value="{{ isset($producto->nombre)?$producto->nombre:old('nombre') }}"
    >
    {!! $errors->first('nombre','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <p><label for="Descripcion" class="control-label">{{"Descripcion"}}</label></p>
    <textarea class="form-control {{$errors->has('descripcion')?'is-invalid':''}}" name="descripcion" id="" cols="30" rows="10">{{ isset($producto->descripcion)?$producto->descripcion:old('descripcion') }}
    </textarea>
    {!! $errors->first('descripcion','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <label for="Imagen" class="control-label">{{"Imagen"}}</label>
    @if (isset($producto->imagen))
        <p>
        <img class="img-thumbnail img-fluid" src="{{ asset('storage/uploads').'/'.$producto->imagen}}" alt="" width="200">
        </p>
    @endif
    <input class="form-control" type="file" name="imagen" id="imagen" value="">
</div>
<div class="form-group">
    <label for="Precio" class="control-label">{{"Precio"}}</label>
    <input class="form-control {{$errors->has('precio')?'is-invalid':''}}" type="text" name="precio" id="precio"
    value="{{ isset($producto->precio)?$producto->precio:old('precio') }}"
    >
    {!! $errors->first('precio','<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    <label for="Disponibilidad" class="control-label">{{"Disponibilidad"}}</label>
    <input class="form-control {{$errors->has('disponibilidad')?'is-invalid':''}}" type="text" name="disponibilidad" id="disponibilidad"
    value="{{ isset($producto->disponibilidad)?$producto->disponibilidad:old('disponibilidad') }}"
    >
    {!! $errors->first('disponibilidad','<div class="invalid-feedback">:message</div>') !!}
</div>
<input class="btn btn-success" type="submit" value="{{ $Modo=='crear'?'Agregar':'Modificar'}}">
<a class="btn btn-primary" href="{{ url('productos') }}">Regresar</a>
