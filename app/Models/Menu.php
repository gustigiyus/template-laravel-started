<?php

namespace App\Models;

use App\Helpers\DateHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_name',
        'menu_desc',
    ];

    protected $casts = [
        'updated_at' => 'datetime',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_menu', 'menu_id', 'user_id')
            ->withPivot('can_add', 'can_edit', 'can_view');
    }

    public function getUpdatedAtAttribute($value)
    {
        return DateHelper::formatTanggalIndonesia($value);
    }
}
