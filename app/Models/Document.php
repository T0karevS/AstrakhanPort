<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'doc_name',
        'doc_link',
        'doc_category', 
        'doc_year',
    ];
}