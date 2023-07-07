@extends('layouts.app')

@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Cargos') }} </div>

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
                        <a class="nav-link" href="{{ URL::to('cargos/create') }}">{{ __('Nueva Cargo') }}</a>
                    </button>
                    @if($cargos->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col" style="width:85%">Nombre</th>
                                <th scope="col" style="width:10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cargos as $cargo)
                            <tr>
                                <th scope="row">{{ $cargo->id }}</th>
                                <td>{{ $cargo->nombre }}</td>
                                <td>

                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-primary btn-sm "><a class="nav-link" href="{{ url('/cargos/'.$cargo->id.'/edit') }}">{{ __('Editar') }}</a></button>

                                        <form id="cargos.destroy-form-{{$cargo->id}}" action="{{ route('cargos.destroy', $cargo) }}" method="POST" class="hidden" onclick="return confirm('¿Estás seguro de que quieres eliminar ?');">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ">Borrar</button>
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