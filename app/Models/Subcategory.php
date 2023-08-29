<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function articles(){
        return $this->hasMany(Article::class);
    }
}
