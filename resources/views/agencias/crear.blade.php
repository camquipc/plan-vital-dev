@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Agencias') }} </div>

                <div class="card-body col-md-5">
                    <form action="/agencias" method="POST">
                        {{ csrf_field() }}
                        @include('agencias.form', ['modo' => 'Crear'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection