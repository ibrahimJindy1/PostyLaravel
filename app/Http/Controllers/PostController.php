<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{



    public function __construct()
    {
        $this->middleware(['auth'])->only(['post','destroy']);
    }

    public function index()
    {
        $posts = Post::latest()->with(['user','likes'])->paginate(20);

        return view('Posts.index',[
            'posts'=>$posts
        ]);

    }

    public function post(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        // Post::create(
        //     [
        //         'user_id'=> auth()->id(),
        //         'body' => $request->body
        //     ]
        // );

        $request->user()->posts()->create($request->only('body'));

        return back();
    }


    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);

        $post->delete();
        return back();
    }
}
