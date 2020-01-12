<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostReuest;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q =\Request::query();

        if(isset($q['category_id'])){
            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(5);
            $posts->load('category','user');
            // dd($posts);
            return view('posts.index',[
                'posts' => $posts,
        ]);

        }else{
            $posts = Post::latest()->paginate(5);
            $posts->load('category','user');
            // dd($posts);
            return view('posts.index',[
                'posts' => $posts,
            ]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create',[
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostReuest $request)
    {
        $post = new Post;
            $input = $request->only($post->getFillable());
        
        $post = $post->create($input);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post->load('category','user','comments.user');
        // dd($post);
        return view('posts.show',[
            'post' => $post,
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
    }

    public function search(Request $request)
    {   // like,"%{}%"であいまい検索
        $posts = Post::where('title','like',"%{$request->search}%")
        ->orWhere('content','like',"%{$request->search}%")
        ->paginate(5);
        $search_result = $request->search.'の検索結果'.count($posts).'件';
        return view('posts.index',[
            'posts' => $posts,
            'search_result' => $search_result,
        ]);

    }
}
