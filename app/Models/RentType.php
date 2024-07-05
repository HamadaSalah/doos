<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];
    
    protected $table = 'rent_types';


    public function car() {

        return $this->belongsToMany(Car::class);
        
    }

    public function rent() {

        return $this->hasMany(Rent::class);
        
    }

    public function getIconAttribute($value) 
    {
        return env('APP_URL').'/storage/'.$value;
    }








}
