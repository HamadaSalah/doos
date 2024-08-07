<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\UploadService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'photo',
        'id_number',
        'licence_status',
        'licence_file',
        'id_number_file',
        'birthday',
        'otp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    ///
    public function getLicenceFileAttribute($value)
    {
        return  env('APP_URL') . '/storage/' . $value;
    }
    public function getIdNumberFileAttribute($value)
    {
        return  env('APP_URL') . '/storage/' . $value;
    }
    public function getPhotoAttribute($value)
    {
        return  env('APP_URL') . '/storage/' . $value;
    }
    

    public function rents() {
        return $this->hasMany(Rent::class);
    }    
    public function favourites() {
        return $this->hasMany(Favourite::class);
    }


}
