<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'type',
        'productname',
        'on',
        'brightness',
        'hue',
        'saturation',
        'reachable',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    // Search helper.
    public static function search($query)
    {
        return empty($query)
            ? self::query()
            : self::where(function ($q) use ($query) {
                $q
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('type', 'like', '%'.$query.'%')
                    ->orWhere('productname', 'like', '%'.$query.'%');
            });
    }
}
