<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    public function show()
    {
        $posts = Post::all();

        return view('home', [
            'posts' => $posts,
        ]);
    }

    public function formCreate(Request $request)
    {
        if ($request->has('name') and $request->has('description') and $request->has('img')) {

            $request->validate([
                'name' => ['required','unique:posts,name', 'max:20'],
                'description' => ['required', 'max:500'],
                'img' => ['required', 'image'],
            ]);

            $path = $request->file('img')->store('images/posts', 'public');

            $post = new Post();
            $post->name = $request->input('name');
            $post->author = Auth::id();
            $post->description = $request->input('description');
            $post->img = $path;
            $post->save();

            $posts = Post::all();

            return view('home', [
                'posts' => $posts,
            ]);
        }
        return view('add-post');
    }
}
