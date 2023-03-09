<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function showComments($id)
    {
        $theme = Theme::findOrFail($id);
        $comments = Theme::findOrFail($id)->comments()->get();

        return view('show-comments', [
            'theme' => $theme,
            'comments' => $comments,
        ]);
    }

    public function create(Request $request, $id)
    {
        $theme = Theme::findOrFail($id);

        if ($request->has('text')) {
            $request->validate([
                'text' => ['required', 'max:5000'],
            ]);
            $comment = new Comment();
            $comment->text = $request->input('text');
            $comment->theme_id = $id;
            $comment->user_id = Auth::id();
            $comment->save();

            return redirect()->route('show-comments', ['id' => $theme]);
        }
    }

    public function showMyComments()
    {
        if(Auth::check()){
            $user = Auth::id();
            $comments = Comment::where('user_id', '=', $user)->get();
        }
        return view('show-my-comments', [
            'comments' => $comments,
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
