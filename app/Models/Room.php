<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user() {

        return $this->BelongsTo(User::class);
        
    }
    public function messages() {

        return $this->hasMany(Message::class);
        
    }
}
