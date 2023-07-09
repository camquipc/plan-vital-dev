@if(count($errors) > 0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">

    <div class="col-md-3">
        <div class="form-group mt-3">
            <label for="nombre">Sucursal</label>
            <select class="form-control" id="agencia" name="agencia" value="{{old('agencia_id')}}">
                @foreach ($agencias as $agencia)
                <option value="{{$agencia->id}}" {{ isset($ejecutivo->agencia_id) && $agencia->id == $ejecutivo->agencia_id ? 'selected' : ''}}>{{$agencia->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mt-3">
            <label for="nombre">Estado</label>
            <select class="form-control" id="estado" name="estado" value="{{old('estado')}}">
                <option value="0">Sano - Trabajando en Oficina</option>
                <option value="0">Vacaciones</option>
                <option value="0">Licencia Normal</option>

            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group mt-3">
            <label for="nombre">Cargo</label>
            <input type="text" class="form-control" id="nombre" placeholder="Test" name="nombre" value="{{ isset($cargo->nombre) ? $cargo->nombre : old('nombre') }}">
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group mt-3">
            <label for="nombre">Jefatura</label>
            <select class="form-control" id="jefatura" name="jefatura" value="{{old('jefatura')}}">
                <option value="0">SI</option>
                <option value="0">NO</option>
            </select>
        </div>
    </div>

    <div class="col-md-2 mt-3">
        <div class="form-group mt-3">
            <label for="nombre"></label>
            <button type="submit" class="btn btn-primary ">Agreagar</button>
        </div>

    </div>
</div>

<div class="row">

    <div class="col-md-3">
        <label for="rut">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha">

        <div class="mt-4 listado">
            <ul class="list-group">
                <li class="list-group-item">Cras justo odio</li>
                <li class="list-group-item">Dapibus ac facilisis in</li>
                <li class="list-group-item">Morbi leo risus</li>
                <li class="list-group-item">Porta ac consectetur ac</li>
                <li class="list-group-item">Vestibulum at eros</li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <table class="table mt-3">
            <thead style="background-color: red;">
                <tr>
                    <th scope="col">Nombre Ejecutivo</th>
                    <th scope="col">Cargo Ejecutivo</th>
                    <th scope="col">Jefatura</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary mt-4">Grabar</button>

</div>