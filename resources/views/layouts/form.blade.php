<div id="message"></div>


<div class="row">

    <div class="col-md-3">
        <div class="form-group mt-3">
            <label for="nombre">Sucursal</label>
            <select class="form-control" id="agencia" name="agencia">
                <option value="">Seleccionar sucursal </option>
                @foreach ($agencias as $agencia)
                <option value="{{$agencia->id}}">{{$agencia->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mt-3">
            <label for="nombre">Estado</label>
            <select class="form-control" id="estado" name="estado">
                <option value="">Seleccionar estado </option>
                @foreach ($estado_ejecutivos as $estado_ejecutivo)
                <option value="{{$estado_ejecutivo->id}}">{{$estado_ejecutivo->estado}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group mt-3">
            <label for="nombre">Cargo</label>
            <select class="form-control" id="cargo" name="cargo" value="" disabled>
                <option value="">Sin cargo </option>
                @foreach ($cargos as $cargo)
                <option value="{{$cargo->id}}">{{$cargo->nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group mt-3">
            <label for="nombre">Jefatura</label>
            <select class="form-control" id="jefatura" name="jefatura">
                <option value="">Seleccionar jefatura</option>
                <option value="SI">SI</option>
                <option value="NO">NO</option>
            </select>
        </div>
    </div>

    <div class="col-md-2 d-flex align-items-end justify-content-md-between">
        <button type="button" class="btn btn-primary" id="btn_agregar">Agreagar</button>
        <button type="button" class="btn btn-outline-danger " id="btn-delete" disabled>Borrar</button>
    </div>
</div>

<div class="row mt-3">
    <input type="hidden" id="selected_ejecutivo" value="null">
    <div class="col-md-3">
        <label for="rut">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha" max="{{ now()->toDateString('Y-m-d') }}">
        <div class="mt-4 listado" id="listado"></div>
    </div>
    <div class="col-md-9">
        <label class="text-center">Registro de asistencias</label>
        <div class="well">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre Ejecutivo</th>
                        <th scope="col">Cargo Ejecutivo</th>
                        <th scope="col">Jefatura</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Fecha</th>

                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 d-flex align-items-end justify-content-md-end">
        <button type="button" class="btn btn-primary mt-4 col-2" id="btn-grabar" disabled>Grabar</button>
    </div>

</div>