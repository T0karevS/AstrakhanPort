<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\NewsImage;

class News extends Model
{
     public $timestamps = false; 
    protected $fillable = ['name', 'text', 'date'];

  public function images()
{
    return $this->hasMany(NewsImage::class, 'news_id');
}
}


