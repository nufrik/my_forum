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
        return route('show-comments');
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

    public function update(Request $request,$id)
    {
        if ($request->has('text')) {
            $request->validate([
                'text' => ['required', 'max:5000'],
            ]);
            $comment = Comment::findOrFail($id);
            $comment->text = $request->input('text');
            $comment->save();

            $request->session()->flash('status', 'Успешно отредактировано!');

            return redirect()->route('my.comments');
        }
        $comment = Comment::findOrFail($id);

        return view('update-comment', [
            'comment' => $comment,
        ]);
    }

    public function delete(Request $request,$id)
    {
        Comment::destroy($id);
        $request->session()->flash('status', 'Успешно удалено!');
        return redirect()->route('my.comments');
    }
}
