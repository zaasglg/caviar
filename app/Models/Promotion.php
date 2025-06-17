<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'promotions';

    /**
     * Атрибуты, которые можно массово назначать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'image_path',
        'banner_image_path',
        'url',
        'is_active',
        'sort_order',
    ];

    /**
     * Атрибуты, которые должны быть приведены к определенным типам.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Получить URL изображения промо-акции.
     */
    public function getImageUrlAttribute(): string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : asset('assets/images/default-promotion.png');
    }

    /**
     * Получить URL баннера промо-акции.
     */
    public function getBannerUrlAttribute(): string
    {
        return $this->banner_image_path ? asset('storage/' . $this->banner_image_path) : asset('assets/images/default-banner.png');
    }

    /**
     * Get the products for the promotion.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promotion_product')
            ->withPivot('selected_sizes')
            ->withTimestamps();
    }
}
