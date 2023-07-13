@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Agencias') }} </div>

                @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show col-md-4" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm flex justify-end">
                        <a class="nav-link" href="{{ URL::to('agencias/create') }}">{{ __('Nueva Agencia') }}</a>
                    </button>
                    @if($agencias->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col" style="width:65%">Nombre</th>
                                <th scope="col" style="width:20%">Código</th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agencias as $agencia)
                            <tr>
                                <th scope="row">{{ $agencia->id }}</th>
                                <td>{{ $agencia->nombre }}</td>
                                <td>{{ $agencia->cod_agencia }}</td>
                                <td>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-sm mr-2"><a class="nav-link" href="{{ url('/agencias/'.$agencia->id.'/edit') }}">{{ __('Editar') }}</a></button>
                                        <a href="{{ route('agencias.destroy', $agencia) }}" class="btn btn-danger" data-confirm-delete="true">Borrar</a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-danger mt-4" role="alert">
                        No hay registros!
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>


@endsection