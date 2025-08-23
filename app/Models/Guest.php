<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Guest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'phone',
        'email',
        'address',
        'id_proof_type',
        'id_proof_number',
        'id_proof_image',
        'emergency_contact_name',
        'emergency_contact_phone',
        'special_requests',
    ];

    protected static function booted(): void
    {
        static::creating(function (Guest $guest) {
            if (empty($guest->slug)) {
                $guest->slug = Str::slug($guest->name . '-' . Str::random(6));
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
