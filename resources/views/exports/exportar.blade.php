<table>
    <thead>
        <tr>
            <th>FECHA</th>
            <th>SUCURSAL</th>
            <th>COD SUCURSAL</th>
            <th>NOMBRE EJECUTIVO</th>
            <th>RUT EJECUTIVO</th>
            <th>CARGO</th>
            <th>JEFATURA</th>
            <th>ESTADO ASISTENCIA</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asistencias as $asistencia)
        <tr>
            <td>{{$asistencia->fecha}}</td>
            <td>{{$asistencia->a_nombre}}</td>
            <td>{{$asistencia->cod_agencia}}</td>
            <td>{{$asistencia->nombres}}</td>
            <td>{{$asistencia->rut}}</td>
            <td>{{$asistencia->c_nombre}}</td>
            <td>{{$asistencia->jefatura}}</td>
            <td>{{$asistencia->estado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>