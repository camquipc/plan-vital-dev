<h5>{{ $modo }} cargo</h5>

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
    <label for="nombre">Nombre Cargo</label>
    <input type="text" class="form-control" id="nombre" placeholder="Test" name="nombre" value="{{ isset($cargo->nombre) ? $cargo->nombre : old('nombre') }}">

</div>


<button type="submit" class="btn btn-primary mt-3">{{ $modo }}</button>
<a class="btn btn-secondary mt-3" href="{{ url('cargos') }}">Regresar</a>