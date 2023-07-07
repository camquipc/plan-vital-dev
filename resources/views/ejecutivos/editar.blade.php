@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ejecutivo') }} </div>
                @if ($errors->any())
                <div class="alert alert-danger col-md-5 p-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="card-body col-md-5">
                    <form action="{{ url('/ejecutivos/'.$ejecutivo->id) }}" method="post">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('ejecutivos.form', ['modo' => 'Editar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection