<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\Comment;
use App\Models\Puntuaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class VideoUserController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    public function upload()
    {
        return view('videos.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->id == $request->id){
            $user = User::find($request->id);
            $updatedate = date('Y-m-d H:i:s');

            $user->update([
            'email'=>$request->email,
            'username'=>$request->username,
            'password'=>bcrypt($request->password),
            'updated_at'=>$updatedate,
            ]);

            Auth::logout();
            return redirect()->route('index');
        }
        else{
            $user = User::find($request->id);
            $updatedate = date('Y-m-d H:i:s');
            $user->update([
            'email'=>$request->email,
            'username'=>$request->username,
            'updated_at'=>$updatedate,
            'rol'=>$request->rol
            ]);

            return redirect()->route('perfil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('videos.edituserinfo',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        $users = User::all();
        return view('videos.editadmin',compact('video','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $video = Video::find($id);
        $video->update([
        'description'=>$request->description,
        'cont'=>$request->cont,
        'title'=>$request->title,
        'created_at'=>$request->created_at,
        'updated_at'=>$request->updated_at,
        'userid'=>$request->userid
        ]);
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $comment = Comment::where('id',$id);
        $comment->delete();
        return redirect()->route('index');
    }

    public function showusers(){
        $allusers = User::all();
    }
}
