<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function showThemes($id)
    {
        $post = Post::find($id);
        $themes = Post::find($id)->themes()->paginate(3);

        return view('show-themes', [
            'post' => $post,
            'themes' => $themes,
        ]);
    }

    public function formCreate(Request $request, $id)
    {
        $post = Post::with(['themes'])->find($id);

        if ($request->has('name') and $request->has('description')){
            $request->validate([
                'name' => ['required','unique:themes,name', 'max:20'],
                'description' => ['required', 'max:20'],
            ]);
            $theme = new Theme();
            $theme->name = $request->input('name');
            $theme->description = $request->input('description');
            $theme->author = Auth::id();
            $theme->post_id = $post->id;
            $theme->save();

            return redirect()->route('show-themes', ['id' => $post]);
        }
        return view('add-theme',[
            'post' => $post,
        ]);
    }
}
