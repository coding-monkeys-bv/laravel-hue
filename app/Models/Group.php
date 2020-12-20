<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'type',
        'class',
        'all_on',
        'any_on',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    // Relations.
    public function lights()
    {
        return $this->belongsToMany(Light::class);
    }

    // Search helper.
    public static function search($query)
    {
        return empty($query)
            ? self::query()
            : self::where(function ($q) use ($query) {
                $q
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('type', 'like', '%'.$query.'%');
            });
    }
}
