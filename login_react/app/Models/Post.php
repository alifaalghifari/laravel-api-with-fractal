<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    // use HasFactory;
    protected $table = 'post';
    protected $fillable = ['user_id', 'content'];

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'Desc');
    }



    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
