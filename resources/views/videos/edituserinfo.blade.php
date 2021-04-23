<?php
use Illuminate\Support\Facades\Auth;
?>

@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">User edit</h1>
        @if(Auth::user()->id == $user->id)
        <form action="{{route('store')}}" method="POST">
            @csrf
            @method('GET')
            <input type="hidden" name="id" value="{{$user->id}}">
            Email
            <br/>
            <input type="text" name="email" value="{{$user->email}}" class="form form-control" required>
            Name
            <br/>
            <input type="text" name="username" value="{{$user->username}}" class="form form-control" required>
            Password
            <br/>
            <input type="password" name="password" class="form form-control" required>
            <br/>
            <p style="color:rgb(255, 0, 0);font-weight:bold;">¡Por favor inserte su contraseña o una nueva para no perder al usuario!</p>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br>
        </form>
        @else
        <form action="{{route('store')}}" method="POST">
            @csrf
            @method('GET')
            <input type="hidden" name="id" value="{{$user->id}}">
            Email
            <br/>
            <input type="text" name="email" value="{{$user->email}}"class="form form-control" required>
            Name
            <br/>
            <input type="text" name="username" value="{{$user->username}}" class="form form-control" required>
            Role
            <br/>
            <input type="text" name="rol" value="{{$user->rol}}" class="form form-control" required>
            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br>
        </form>
        @endif
    <br/>
    </div>

    @endsection

