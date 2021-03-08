@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Video edit</h1>
        <form action="{{route('updateinfo')}}" method="POST">
            @csrf
            @method('GET')
            Email
            <br/>
            <input type="text" name="email" value="{{$user->email}}" class="form form-control">
            Name
            <br/>
            <input type="text" name="username" value="{{$user->username}}" class="form form-control">
            Password
            <br/>
            <input type="password" name="password" value="{{$user->password}}" class="form form-control">
            <br/>
            <p style="color:rgb(255, 0, 0);font-weight:bold;">¡Por favor inserte su contraseña o una nueva para no perder al usuario!</p>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br>
        </form>
    <br/>
    </div>

    @endsection

