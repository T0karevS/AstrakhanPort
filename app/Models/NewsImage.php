<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    protected $fillable = ['image_path', 'news_id'];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}   