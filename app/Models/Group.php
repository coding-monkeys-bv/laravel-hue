<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
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
        'class',
        'all_on',
        'any_on',
    ];

    public function lights()
    {
        return $this->belongsToMany(Light::class);
    }
}
