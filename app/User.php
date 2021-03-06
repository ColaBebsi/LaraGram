<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Eloquent Relationship  */
    // A User have one Profile
    public function profile()
    {
        // We don't need to use App\Profile because they belong in the same namespace
        return $this->hasOne(Profile::class);
    }

    // A User have many Posts
    public function posts() 
    {
        // We don't need to use App\Post because they belong in the same namespace
        // Show the latest post first
        return $this->hasMany(Post::class)->orderBy('created_at', 'desc');
    }
}
