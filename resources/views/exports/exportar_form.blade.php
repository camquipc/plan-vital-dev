@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Exportar Excel') }} </div>

                <div class="card-body col-md-5">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="/exportar" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <label for="f_inicial">Fecha Inicial</label>
                            <input type="date" class="form-control" id="f_inicial" name="fecha_inicial">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="f_final">Fecha Final</label>
                            <input type="date" class="form-control" id="f_final" name="fecha_final">

                        </div>
                        <a class="btn btn-secondary mt-3" href="{{ url('asistencias') }}">Regresar</a>
                        <button type="submit" class="btn btn-primary mt-3">General Excel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection