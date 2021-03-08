<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
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
        $videos = Video::all()->where('userid',$id);
        return view('videos.perfil',compact('videos','id','email','name','role'));
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
    public function show()
    {
        //$videos = Video::all();
        //return view('videos.show',compact('videos'));
    }

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
        $video=Video::find($id);
        $video->update([
        'description'=>$request->description,
        'cont'=>$request->cont,
        'title'=>$request->title,
        'video'=>$request->video,
        'created_at'=>$request->created_at,
        'updated_at'=>$request->updated_at,
        'userid'=>$userid
        ]);
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }

    public function updateinfo(Request $request)
    {
        $id = Auth::user()->id;
        $rol = Auth::user()->rol;
        $createdate = Auth::user()->created_at;
        $user = User::find($id);
        $updatedate = date('Y-m-d H:i:s');
        $user->update([
        'id'=>$request->id,
        'email'=>$request->email,
        'username'=>$request->username,
        'password'=>bcrypt($request->password),
        'created_at'=>$createdate,
        'updated_at'=>$updatedate,
        'rol'=>$rol
        ]);

        Auth::logout();
        return redirect()->route('index');
    }

    public function edituserinfo()
    {
        $user = Auth::user();
        return view('videos.edituserinfo',compact('user'));
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
        $video->delete();
        return redirect()->route('index');
    }
}
