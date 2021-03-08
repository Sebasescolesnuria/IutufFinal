@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Your Info</h1>
        <div style="width:100%;display:flex;flex-direction:column;">
            <div style="width:100%;display:flex;flex-direction:row;">
                <p style="width:50%;">Your id</p>
                <p style="width:50%;">{{$id}}</p>
            </div>
            <div style="width:100%;display:flex;flex-direction:row;">
                <p style="width:50%;">Your email</p>
                <p style="width:50%;">{{$email}}</p>
            </div>
            <div style="width:100%;display:flex;flex-direction:row;">
                <p style="width:50%;">Your name</p>
                <p style="width:50%;">{{$name}}</p>
            </div>
            <div style="width:100%;display:flex;flex-direction:row;">
                <p style="width:50%;">Your rol</p>
                <p style="width:50%;">{{$role}}</p>
            </div>
        </div>
        <a class="btn btn-primary" href="{{route('edituserinfo')}}">Edit</a>
        <h1 class="my-4">Your Videos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Cont</th>
                    <th>Title</th>
                    <th>Video</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                </tr>
            @foreach($videos as $video)
                <tr>
                    <td>{{$video->description}}</td>
                    <td>{{$video->cont}}</td>
                    <td>{{$video->title}}</td>
                    <td>@if($video->video!=null)<video src="{{asset('storage/'.$video->video)}}" width="150px" height="150px" controls>@endif</td>
                    <td>{{$video->created_at}}</td>
                    <td>{{$video->updated_at}}</td>
                    <td><a class="btn btn-primary" href="{{route('video.edit',$video->id)}}">Edit</a></td>
                </tr>
            @endforeach
            </thead>
        </table>
    <br/>
    </div>

    @endsection
