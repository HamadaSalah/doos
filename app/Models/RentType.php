<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    protected $table = 'rent_types';


    public function car() {

        return $this->belongsToMany(Car::class);
        
    }

    public function rent() {

        return $this->hasMany(Rent::class);
        
    }









}
