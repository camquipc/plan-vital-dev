<h5>{{ $modo }} agencia</h5>

@if(count($errors) > 0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


<div class="form-group mt-3">
    <label for="nombre">Nombre Agencia</label>
    <input type="text" class="form-control" id="nombre" placeholder="Test" name="nombre" value="{{ isset($agencia->nombre) ? $agencia->nombre : old('nombre') }}">

</div>
<div class=" form-group mt-3">
    <label for="cod_agencia">Código Agencia</label>
    <input type="text" class="form-control" id="cod_agencia" placeholder="T-002" name="cod_agencia" value="{{ isset($agencia->cod_agencia) ? $agencia->cod_agencia : old('cod_agencia') }}">
</div>

<button type="submit" class="btn btn-primary mt-3">{{ $modo }}</button>
<a class="btn btn-secondary mt-3" href="{{ url('agencias') }}">Regresar</a>