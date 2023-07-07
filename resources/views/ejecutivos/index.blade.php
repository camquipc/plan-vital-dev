@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ejecutivos') }} </div>

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
                        <a class="nav-link" href="{{ URL::to('ejecutivos/create') }}">{{ __('Nuevo Ejecutivo') }}</a>
                    </button>
                    @if($ejecutivos->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col" style="width:20%">Nombre</th>
                                <th scope="col" style="width:20%">RUT</th>
                                <th scope="col" style="width:20%">Agencia</th>
                                <th scope="col" style="width:20%">Cargo</th>
                                <th scope="col" style="width:5%">Estado</th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ejecutivos as $ejecutivo)
                            <tr>
                                <th scope="row">{{ $ejecutivo->id }}</th>
                                <td>{{ $ejecutivo->nombres }}</td>
                                <td>{{ $ejecutivo->rut }}</td>
                                <td>{{ $ejecutivo->a_nombre }}</td>
                                <td>{{ $ejecutivo->c_nombre }}</td>
                                <td>{{ $ejecutivo->estado }}</td>
                                <td>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-sm mr-2"><a class="nav-link" href="{{ url('/ejecutivos/'.$ejecutivo->id.'/edit') }}">{{ __('Editar') }}</a></button>

                                        <form id="ejecutivos.destroy-form-{{$ejecutivo->id}}" action="{{ route('ejecutivos.destroy', $ejecutivo) }}" method="POST" class="hidden" onclick="return confirm('¿Estás seguro de que quieres eliminar ?');">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                        </form>
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