<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'role_desc',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return DateHelper::formatTanggalIndonesia($value);
    }
}
