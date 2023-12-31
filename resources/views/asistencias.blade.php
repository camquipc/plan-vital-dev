@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Asistencia Sucursales 4.0') }}</div>
                <div class="card-body">
                    <form action="/cargos" method="POST">
                        {{ csrf_field() }}
                        @include('layouts.form', ['modo' => 'Crear'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection