<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'photo_id', 'comment'];

    /**
     * Relasi: Comment dimiliki oleh satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Comment terkait dengan satu Photo.
     */
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
}