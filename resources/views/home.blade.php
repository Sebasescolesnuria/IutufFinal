@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
                @if(Auth::user()->hasRole('admin'))
                    <div>Acces com administrador</div>
                    <a class="btn btn-info" href="{{route('video.index')}}">View videos</a>
                @else
                    <div>Acces com usuari</div>
                    <a class="btn btn-info" href="{{route('video.index')}}">View videos</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
