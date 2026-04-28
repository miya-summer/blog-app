<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 一括保存（createメソッドなど）を許可する項目を指定
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
