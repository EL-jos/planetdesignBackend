<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public $incrementing = false;

    public function colors(){
        return $this->belongsToMany(Color::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
