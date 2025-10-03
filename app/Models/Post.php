<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'club_id', 'user_id'];



    public function author()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the foreign key
    }


    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    // Relationship to User (the user who created the post)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
