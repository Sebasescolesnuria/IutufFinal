<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
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
        //
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
        $videos = Video::all();
        return view('videos.show',compact('videos'));
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
        $video=Video::find($id);
        $video->update([
        'description'=>$request->description,
        'cont'=>$request->cont,
        'title'=>$request->title,
        'video'=>$request->video,
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
        $video = Video::find($id);
        Video::where('id',$video)->delete();
        $videos = Video::all();
        return view('videos.index',compact('videos'));
    }
}
