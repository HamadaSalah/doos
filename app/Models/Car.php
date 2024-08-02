<?php

namespace App\Models;

use App\Services\UploadService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type', 'model', 'year', 'price', 'assurance', 'number', 'licence_file', 'kilos', 'with_driver', 'status', 'company_id', 'branch_id', 'lat', 'long', 'engine','bags','pass_count'];
    
    protected $appends = ['favourite'];
    /*
     |--------------------------------------------------------------------------
     | Relations methods
     |--------------------------------------------------------------------------
    */

    public function company() {

        return $this->belongsTo(Company::class);

    }

    
    public function rentTypes() {

        return $this->belongsToMany(RentType::class);

    }

    public function maintains() {

        return $this->hasMany(Maintain::class)->latest();

    }
    
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function firstFile(): MorphOne
    {
        return $this->morphOne(File::class, 'fileable')->orderBy('created_at', 'asc');
    }

    public function file(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function getLicenceFileAttribute($value) 
    {
        return env('APP_URL').'/storage/'.$value;
    }

    public function getAssuranceAttribute($value) 
    {
        if($value == '0') {
            return 'تامين غير شامل ';
        }
        
        return 'تامين شامل';
        
    }
    public function getFavouriteAttribute() 
    {
        if($this->favourite()->count() >= 1) {
            return true;
        }
        return false;
        
    }

    public function getWithDriverAttribute($value) 
    {
        if($value == '0') {
            return 'بدون سائق ';
        }
        
        return 'بسائق';
        
    }

    public function getStatusAttribute($value) 
    {
        if($value == 0) {
            return 'متاحة';
        }
        
        return 'غير متاحة';
        
    }
    
    public function getkilosAttribute($value) 
    {
        return  "كيلومتر  / اليوم ". $value  ;
        
    }
 
    public function favourite() {
        return $this->hasMany(Favourite::class);
    }

}
