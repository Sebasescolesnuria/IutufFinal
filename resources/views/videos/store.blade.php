@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">New Video</h1>
        <form action="{{route('video.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            Description
            <br/>
            <input type="text" name="description" value="{{$video->description}}" class="form form-control">
            Title
            <br/>
            <input type="text" name="title" value="{{$video->title}}" class="form form-control">
            Content
            <br/>
            <input type="text" name="cont" value="{{$video->cont}}" class="form form-control">
            Route
            <br/>
            <input type="text" name="route" value="{{$video->route}}" class="form form-control">
            created_at
            <br/>
            <input type="text" name="created_at" value="{{$video->created_at}}" class="form form-control">
            updated_at
            <br/>
            <input type="text" name="updated_at" value="{{$video->updated_at}}" class="form form-control">
            Owner
            <br/>
            <input class="list-group" list="owner_id" name="userid" value="{{$video->userid}}">
            @foreach($users as $user)
                <datalist id="userid">
                    <option value="{{$user->id}}">{{$user->email}}</option>
                </datalist>
            @endforeach
            <br/>
            <input type="file" name="photo">

            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br/>
        </form>
    </br>
    </div>

    @endsection
