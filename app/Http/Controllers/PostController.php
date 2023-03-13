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

            $request->session()->flash('status', 'Пост добавлен!');

            return redirect()->route('home');
        }
        return view('add-post');
    }

    public function update(Request $request, $id)
    {
        if ($request->has('name') and $request->has('description') and $request->has('img')) {

            $request->validate([
                'name' => ['required', 'unique:posts,name', 'max:20'],
                'description' => ['required', 'max:500'],
                'img' => ['required', 'image'],
            ]);

            $path = $request->file('img')->store('images/posts', 'public');

            $post = Post::findOrFail($id);
            $post->name = $request->input('name');
            $post->description = $request->input('description');
            $post->img = $path;
            $post->save();

            $request->session()->flash('status', 'Успешно отредактировано!');

            return redirect()->route('home');
        }
        $post = Post::findOrFail($id);

        return view('update-post', [
            'post' => $post,
        ]);
    }

    public function delete(Request $request,$id)
    {
        Post::destroy($id);
        $request->session()->flash('status', 'Успешно удалено!');
        return redirect()->route('home');
    }

    public function showMyPosts()
    {
        if(Auth::check()){
            $user = Auth::id();
            $posts = Post::where('author', '=', $user)->get();
        }
        return view('show-my-posts', [
           'posts' => $posts,
        ]);
    }


}
