<h5>{{ $modo }} ejecutivo</h5>

@if(count($errors) > 0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<th scope="col" style="width:60%">Agencia</th>
<th scope="col" style="width:20%">Cargo</th>
<th scope="col" style="width:20%">Estado</th>
<div class="form-group mt-3">
    <label for="nombre">Nombres</label>
    <input type="text" class="form-control" id="nombres" placeholder="Test" name="nombres" value="{{ isset($ejecutivo->nombres) ? $ejecutivo->nombres : old('nombres') }}">

</div>
<div class=" form-group mt-3">
    <label for="rut">RUT</label>
    <input type="text" class="form-control" id="rut" placeholder="T-002" name="rut" value="{{ isset($ejecutivo->rut) ? $ejecutivo->rut : old('rut') }}">
</div>

<div class="form-group">
    <label for="cargo">Cargo</label>
    <select class="form-control" id="cargo" name="cargo">
        <option value="0">Selecciona un cargo</option>
        @foreach ($cargos as $cargo)
        <option value="{{$cargo->id}}" {{ isset($ejecutivo->rut) && $cargo->id == $ejecutivo->cargo_id ? 'selected' : ''}}>{{$cargo->nombre}}</option>
        @endforeach

    </select>
</div>


<div class="form-group">
    <label for="cargo">Agencia</label>
    <select class="form-control" id="agencia" name="agencia" value="{{old('agencia_id')}}">
        <option value="0">Selecciona una agencia</option>
        @foreach ($agencias as $agencia)
        <option value="{{$agencia->id}}" {{ isset($ejecutivo->agencia_id) && $agencia->id == $ejecutivo->agencia_id ? 'selected' : ''}}>{{$agencia->nombre}}</option>
        @endforeach
    </select>
</div>


<div class="form-group">
    <label for="cargo">Estado</label>
    <select class="form-control" id="estado" name="estado">
        <option value="0">Selecciona un estado</option>
        @isset($ejecutivo)
        @if ($ejecutivo->estado === 'V')
        <option value="V" selected>V</option>
        <option value="N">N</option>
        @else
        <option value="V">V</option>
        <option value="N" selected>N</option>
        @endif
        @else
        <option value="V">V</option>
        <option value="N">N</option>
        @endisset
    </select>
</div>

<button type="submit" class="btn btn-primary mt-3">{{ $modo }}</button>
<a class="btn btn-secondary mt-3" href="{{ url('ejecutivos') }}">Regresar</a>