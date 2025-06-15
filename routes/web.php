<?php

use App\Http\Controllers\CartController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Pages\About;
use App\Livewire\Pages\CartPage;
use App\Livewire\Pages\Catalog;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Delivery;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\News;
use App\Livewire\Pages\Profile;
use App\Livewire\Pages\StockPage;
use App\Livewire\Pages\Thanks;
use App\Livewire\PublicOffer;
use App\Livewire\PublicSec;
use App\Livewire\Single\GiftSingle;
use App\Livewire\Single\PostSingle;
use App\Livewire\Single\ProductSingle;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Client\Request;

// pages
Route::get('/', Home::class)->name('home');
Route::get('/public-offer', PublicOffer::class)->name('public.offer');
Route::get('/public-sec', PublicSec::class)->name('public.sec');
Route::get('/catalog/{id?}', Catalog::class)->name('catalog');
Route::get('/about', About::class)->name('about');
Route::get('/delivery', Delivery::class)->name('delivery');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/news', News::class)->name('news');
Route::get('/thanks', Thanks::class)->name('thanks.page');
Route::get('/stock/{id}', StockPage::class)->name('stock');

// single
Route::get('/product/{id}', ProductSingle::class)->name('catalog.single');
Route::get('/gift/{id}', GiftSingle::class)->name('gift.single');
Route::get('/post/{id}', PostSingle::class)->name('post.single');

// auth
Route::get('/login', Login::class)->name('login');
Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
Route::get('/register', Register::class)->name('register');
Route::get('/profile', Profile::class)->name('profile')->middleware('auth');

// cart
Route::get('/cart', CartPage::class)->name('cart');
Route::post('/cart/save', [CartController::class, 'save'])->name('cart.save');

Route::get('/visa-payment/{order}', function ($orderId) {
    $html = Cache::get("visa_payment_$orderId");

    if (!$html) {
        abort(404, 'Сессия платежа истекла. Попробуйте снова.');
    }

    return response($html)->header('Content-Type', 'text/html');
})->name('visa.payment');

Route::post('/payment-notify', function(Request $request) {
	dd($request);
})->name('visa.notify');

Route::post('/payment-result', function(Request $request) {
    return redirect()->route('thanks.page');
})->name('visa.result');
