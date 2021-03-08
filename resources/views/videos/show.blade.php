@extends('layouts.app')

@section('content')
<div class="col-lg-12">

    <h1 class="my-4">Videos</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Cont</th>
                <th>Title</th>
                <th>Video</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>Userid</th>
                <th></th>
            </tr>
        @foreach($videos as $video)
            <tr>
                <td>{{$video->description}}</td>
                <td>{{$video->cont}}</td>
                <td>{{$video->title}}</td>
                <td>@if($video->video!=null)<video src="{{asset('storage/'.$video->video)}}" width="150px" height="150px" controls>@endif</td>
                <td>{{$video->created_at}}</td>
                <td>{{$video->updated_at}}</td>
                <td>{{$video->userid}}</td>
                @if($video->userid == Auth::user()->id || Auth::user()->hasRole('admin'))<td><a class="btn btn-primary" href="{{route('video.edit',$video->id)}}">Edit</a></td>@endif
            </tr>
        @endforeach
            <br>
        </thead>
    </table>
</div>
@endsection
