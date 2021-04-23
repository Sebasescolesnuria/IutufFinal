@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    <div style="display:flex;flex-direction:column;">
        <h2 style="margin:0;padding:0;width:100%;text-align:center;">{{$video->title}}</h2>
        <div style="margin:0;padding:0;width:100%;display:flex;flex-direction:row;justify-content:center;align-items:center;">
            <video src="{{asset('storage/'.$video->video)}}" width="550px" height="400px" controls>
        </div>
        <div style="margin-top:50px;width:100%;display:flex;flex-direction:row;justify-content:center;align-items:center;">
            <h4 style="text-align:center;width:50%;">{{$video->description}}</h4>
            <h4 style="text-align:center;width:50%;">{{$video->cont}}</h4>
        </div>
    </div>
    @if($puntuaciones == 0)
    <form action="{{route('insertpuntuaciones')}}" method="POST" style="display:flex;flex-direction:row;justify-content:center;align-items:center;">
        @csrf
        @method('GET')
        <input type="text" name="videoid" value="{{$video->id}}" hidden>
        <input type="submit" name="megusta" class="btn btn-success" value="megusta">
        <input type="submit" name="nomegusta" class="btn btn-danger" value="nomegusta" style="margin-left:1%;">
    </form>
    @else
        <h3>Ya ha votado!</h3>
    @endif

    <br>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Comment</th>
                <th>User</th>
                <th>Created At</th>
                <th></th>
            </tr>
        @foreach($comments as $comment)
            <tr>
                <td>{{$comment->id}}</td>
                <td>{{$comment->comment}}</td>
                <td>{{$comment->userid}}</td>
                <td>{{$comment->created_at}}</td>
                <td>
                    @if(Auth::user()->hasRole('admin'))
                        <form action="{{route('videouser.destroy',$comment->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    @endif
                </td>
                <td></td>
            </tr>

        @endforeach
        </thead>
    </table>
    <br>
        <form action="{{route('insertcomments')}}" method="POST">
            @csrf
            @method('GET')
            <input type="text" name="videoid" value="{{$video->id}}" hidden>
            Deja que te ha parecido el video
            <br/>
            <input type="text" name="comment" class="form form-control" required>
            <br>
            <input type="submit" class="btn btn-primary" value="Save">
        </form>
        <br>
</div>
@endsection
