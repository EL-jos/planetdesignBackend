<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = false;
    public $incrementing = false;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quotes(){
        return $this->belongsToMany(Quote::class);
    }
}
