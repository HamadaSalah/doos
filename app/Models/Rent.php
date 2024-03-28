<?php

namespace App\Models;

use App\Enums\RentLocationEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    
    protected $guarded = [];

 
    public function getLocationAttribute($value) {

        return RentLocationEnum::transValue($value);

    }

    public function services() {

        return $this->belongsToMany(Service::class);
        
    }

    
    public function returnType() {

        return $this->belongsTo(ReturnType::class, 'return_type_id', 'id');
        
    }

}
