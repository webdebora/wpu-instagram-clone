<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'caption', 'image_path'];

    /**
     * Relasi: Photo dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Photo memiliki banyak Like.
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Relasi: Photo memiliki banyak Comment.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedBy(User $user)
{
    return $this->likes()->where('user_id', $user->id)->exists();
}
}
