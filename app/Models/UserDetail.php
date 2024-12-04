<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'nik',
        'dob',
        'gender',
        'address',
    ];

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y');
    }
}
