<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'founded_date',
        'contact_email',
        'contact_phone',
        'address',
        'website',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'club_user')
            ->withPivot('role', 'created_at')
            ->withTimestamps();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }




}
