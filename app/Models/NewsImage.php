<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsImage extends Model
{
    protected $fillable = ['image_path', 'news_id'];
    public $timestamps = false;
    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}   