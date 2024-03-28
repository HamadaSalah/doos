<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'descreiption'];

    public function rents() {

        return $this->belongsToMany(Rent::class);
        
    }

}
