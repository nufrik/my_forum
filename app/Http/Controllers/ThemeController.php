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

    public function showMyThemes()
    {
        if(Auth::check()){
            $user = Auth::id();
            $themes = Theme::where('author', '=', $user)->get();
        }
        return view('show-my-themes', [
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

            $request->session()->flash('status', 'Тема добавлена!');

            return redirect()->route('show-themes', ['id' => $post]);
        }
        return view('add-theme',[
            'post' => $post,
        ]);
    }

    public function update(Request $request,$id)
    {
        if ($request->has('name') and $request->has('description')) {
            $request->validate([
                'name' => ['required','unique:themes,name', 'max:20'],
                'description' => ['required', 'max:20'],
            ]);
            $theme = Theme::findOrFail($id);
            $theme->name = $request->input('name');
            $theme->description = $request->input('description');
            $theme->save();

            $request->session()->flash('status', 'Успешно отредактировано!');

            return redirect()->route('my.themes');
        }
        $theme = Theme::findOrFail($id);

        return view('update-theme', [
            'theme' => $theme,
        ]);
    }

    public function delete($id)
    {
        Theme::destroy($id);
        return redirect()->route('my.themes');
    }
}
