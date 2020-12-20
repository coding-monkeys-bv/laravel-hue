<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Webhook extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action_id',
        'hue_id',
        'name',
        'description',
        'token',
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
