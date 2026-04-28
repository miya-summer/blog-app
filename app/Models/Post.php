<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 一括保存（createメソッドなど）を許可するカラムを指定
    protected $fillable = ['user_id', 'title', 'body'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
