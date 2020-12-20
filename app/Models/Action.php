<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Action extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'action',
    ];

    protected $casts = [
        'action' => 'json',
    ];

    // Search helper.
    public static function search($query)
    {
        return empty($query)
            ? self::query()
            : self::where(function ($q) use ($query) {
                $q
                    ->where('name', 'like', '%'.$query.'%')
                    ->orWhere('description', 'like', '%'.$query.'%');
            });
    }
}
