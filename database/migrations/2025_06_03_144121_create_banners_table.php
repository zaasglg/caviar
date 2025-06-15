<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Заголовок баннера');
            $table->string('image_path')->comment('Путь к изображению баннера');
            $table->string('url')->comment('Ссылка для перехода');
            $table->boolean('is_active')->default(true)->comment('Активен ли баннер');
            $table->integer('sort_order')->default(0)->comment('Порядок сортировки');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
