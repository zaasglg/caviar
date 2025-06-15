<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Маршруты, исключённые из CSRF-проверки
     *
     * @var array<int, string>
     */
    protected $except = [
        'payment-result', // Или '/payment-result' — оба варианта подходят
    ];
}
