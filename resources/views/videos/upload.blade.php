@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Videos</h1>
        <form action="{{route('video.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            Description
            <br/>
            <input type="text" name="description" class="form form-control">
            Title
            <br/>
            <input type="text" name="title" class="form form-control">
            Content
            <br/>
            <input type="text" name="cont" class="form form-control">
            Video
            <br/>
            <input type="file" name="video" class="form form-control">
            <br/>
            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br/>
        </form>
    </br>
    </div>

    @endsection
