<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingApp extends Model
{
    use HasFactory;

    protected $table = 'app_settings';
    protected $fillable = [
        'name_app',
        'logo_app',
        'desc_app',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return DateHelper::formatTanggalIndonesia($value);
    }
}
