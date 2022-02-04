<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('post.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validate=Validator::make($request->all(),[
            "title"=>'required',
            "description"=>'required',
        ]);
        if ($validate->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validate->messages(),
            ]);
        }

        else{
            $post=new Post;
            $post->title=$request->title;
            $post->description=$request->description;
            $post->save();
            return response()->json([
               'status'=>200,
               'message'=>'post Added',
            ]);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $posts=Post::all();
        return response()->json([
           'posts'=>$posts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post=Post::find($id);
        if ($post){
            return response()->json([
               'status'=>200,
               'posts'=>$post
            ]);
        }
        else{
            return response()->json([
                'status'=>400,
                'message'=>"post not Found",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validate=Validator::make($request->all(),[
            "title"=>'required',
            "description"=>'required',
        ]);
        if ($validate->fails()){
            return response()->json([
                'status'=>400,
                'errors'=>$validate->messages(),
            ]);
        }

        else{
            $post=Post::find($id);
            if ($post){
                $post->title=$request->title;
                $post->description=$request->description;
                $post->save();
                return response()->json([
                    'status'=>200,
                    'message'=>'post Added',
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'post not fund',
                ]);
            }


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post=Post::find($id);
        $post->delete();
        return response()->json([
           'message'=>'postDeleted',
        ]);
    }
}
