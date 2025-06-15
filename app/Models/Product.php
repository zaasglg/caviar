<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'status',
        'image', 
        'description', 
        'category', 
        'catalog_id', 
        'expiration_date',
        'storage_conditions',
        'made_by',
        'composition',
        'food_value',
        'energy_value',
        'sizes'
    ];

    public function catalog() {
        return $this->belongsTo(Catalog::class);
    }

    protected $casts = [
        'sizes' => 'array',
        'status' => 'boolean',
    ];

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product');
    }
}
