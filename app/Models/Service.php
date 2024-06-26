<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name', 'descreiption'];

    public function rents() {

        return $this->belongsToMany(Rent::class);
        
    }

}
