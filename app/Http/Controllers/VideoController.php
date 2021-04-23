<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\Comment;
use App\Models\Puntuaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class VideoController extends Controller
{
    function __construct()
    {
        $this->middleware(['auth']);
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
        //
    }

    public function upload()
    {
        return view('videos.upload');
    }

    public function perfil()
    {
        $email = Auth::user()->email;
        $id = Auth::user()->id;
        $role = Auth::user()->rol;
        $name = Auth::user()->username;
        $role = DB::table('roles')->select('rol')->where('id',$role)->get();

        if(strpos($role,'admin')){
            $role = 'admin';
        }
        else{
            $role = 'guest';
        }

        $videos = Video::all()->where('userid',$id);
        $user = User::all();
        return view('videos.perfil',compact('videos','id','email','name','role','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path=$request->file('video')->store('videos','public');
        $iduser = Auth::user()->id;
        Video::create([
                        'description'=>$request->description,
                        'cont'=>$request->cont,
                        'title'=>$request->title,
                        'video'=>$path,
                        'create_date'=>$request->create_date,
                        'modify_date'=>$request->modify_date,
                        'userid'=>$iduser
            ]);
            $videos = Video::all();
            return view('videos.index',compact('videos'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video=Video::find($id);
        $users=User::all();
        return view('videos.edit',compact('video','users'));
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
        $userid = Auth::user()->id;
        $video = Video::find($id);
        $video->update([
        'description'=>$request->description,
        'cont'=>$request->cont,
        'title'=>$request->title,
        'created_at'=>$request->created_at,
        'updated_at'=>$request->updated_at,
        'userid'=>$userid
        ]);
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }

    public function show($id)
    {
        $user = Auth::user()->id;
        $video = Video::find($id);
        $puntuaciones = Puntuaciones::all()->where('videoid',$id)->where('userid',$user);
        $puntuaciones = count($puntuaciones);
        $comments = Comment::all()->where('videoid',$id);
        $users = User::all();

        return view('videos.show',compact('video','comments','puntuaciones'));
    }

    public function insertcomments(Request $request){
        $created_at = date('Y-m-d H:i:s');
        $upated_at = date('Y-m-d H:i:s');
        $user = Auth::user()->id;

        Comment::create([
            'comment'=>$request->comment,
            'userid'=>$user,
            'videoid'=>$request->videoid,
            'created_at'=>$created_at,
            'updated_at'=>$upated_at
        ]);
        return redirect()->route('index');
    }

    public function insertpuntuaciones(Request $request){
        if($request->megusta){
            $puntuacion = true;
        }
        else{
            $puntuacion = false;
        }

        $user = Auth::user()->id;
        $created_at = date('Y-m-d H:i:s');
        $updated_at = date('Y-m-d H:i:s');
        $user = Auth::user()->id;

        Puntuaciones::create([
            'puntuacion'=>$puntuacion,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at,
            'videoid'=>$request->videoid,
            'userid'=>$user
        ]);
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::where('id',$id);
        $comments = Comment::where('videoid',$id);
        $puntuaciones = Puntuaciones::where('videoid',$id);
        $comments->delete();
        $puntuaciones->delete();
        $video->delete();
        return redirect()->route('index');
    }
}
