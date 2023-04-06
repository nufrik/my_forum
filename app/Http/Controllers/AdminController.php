<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $posts = Post::all();
        $themes = Theme::all();
        $comments = Comment::all();
        return view('admin', [
            'users' => $users,
            'posts' => $posts,
            'themes' => $themes,
            'comments' => $comments
        ]);
    }

    public function showUserProfile($id)
    {
        if(Auth::check() and Auth::user()->status_id == 1) {
            $user = User::findOrFail($id);

            return view('show-user-profile', [
                'user' => $user
            ]);
        }   else {
             return redirect('404');
        }
    }

    public function changeStatus($id)
    {
        if(Auth::check() and Auth::user()->status_id == 1){
            $user = User::findOrFail($id);

            if($user->status_id == 1){
                $user->status_id = 2;
            }elseif ($user->status_id == 2){
                $user->status_id = 1;
            }
            $user->save();
            return redirect()->route('admin.panel');
        } else {
            return redirect('404');
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::check() and Auth::user()->status_id == 1) {
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

                return redirect()->route('admin.panel');
            }
            $post = Post::findOrFail($id);

            return view('update-post', [
                'post' => $post,
            ]);
        } else {
            return redirect('404');
        }
    }
}
