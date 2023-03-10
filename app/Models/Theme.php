<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'author', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class,'post_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
