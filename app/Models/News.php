<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'hero', 'banner', 'description', 'exception'];

    protected $casts = [
        'banner' => 'boolean',
    ];
 
}
