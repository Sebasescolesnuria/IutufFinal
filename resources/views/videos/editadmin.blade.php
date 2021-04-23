@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Video edit</h1>
        <form action="{{route('video.update',$video->id)}}" method="POST">
            @csrf
            @method('PUT')
            Title
            <br/>
            <input type="text" name="title" value="{{$video->title}}" class="form form-control">
            Description
            <br/>
            <input type="text" name="description" value="{{$video->description}}" class="form form-control">
            Content
            <br/>
            <input type="text" name="cont" value="{{$video->cont}}" class="form form-control">
            Owner
            <br/>
            <input class="list-group" list="userid" name="userid" value="{{$video->userid}}">
            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br>
        </form>
        <form action="{{route('video.destroy',$video)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Remove</button>
        </form>
        <br/>
    <br/>
    </div>

    @endsection
