<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['img'];

    public function getImgAttribute($value) 
    {
        return env('APP_URL').'/storage/'.$value;
    }

}
