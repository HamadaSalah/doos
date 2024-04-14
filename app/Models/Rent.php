<?php

namespace App\Models;

use App\Enums\RentLocationEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rent extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

 
    public function getLocationAttribute($value) {

        return RentLocationEnum::transValue($value);

    }

    public function services() {
        return $this->belongsToMany(Service::class);
    }
    public function car() {
        return $this->belongsTo(Car::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }

    
    public function returnType() {

        return $this->belongsTo(ReturnType::class, 'return_type_id', 'id');
        
    }

}
