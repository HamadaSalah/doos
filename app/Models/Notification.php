<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['head', 'body', 'user_id'];

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->diffForHumans();
    }
    
}
