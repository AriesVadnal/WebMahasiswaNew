<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum';
    protected $fillable = [
        'judul', 'slug', 'konten','user_id'
    ];

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
