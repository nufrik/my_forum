<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showProfile()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $user = User::findOrFail($userId);
        }
        return view('show-my-profile', [
            'user' => $user,
        ]);
    }
}
