<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [ 'amount', 'reason', 'by'];

    protected $appends = ['date', 'time'];

    public function getTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('H:i:s');
    }

    public function getDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('Y-m-d');
    }


}
