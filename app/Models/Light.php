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
        'hue_id',
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
}
