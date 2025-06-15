<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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
        'image_path',
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
     * Регистрация медиа-коллекций.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('promotion')
            ->singleFile();
    }

    /**
     * Get the products for the promotion.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promotion_product');
    }
}
