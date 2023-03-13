<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin', [
            'users' => $users
        ]);
    }

    public function showUserProfile($id)
    {
        $user = User::findOrFail($id);
        return view('show-user-profile', [
            'user' => $user
        ]);
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
}
