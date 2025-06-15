<?php

namespace App\Livewire\Pages;

use App\Models\Address;
use App\Models\City;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class CartPage extends Component
{
    public $cities = [];
    public $user_addresses = [];
    public $carts = [];
    public $total = [];
    public $totalCount = [];

    // Поля адреса
    public $city;
    public $address = "";

    // Данные пользователя
    public $name = "";
    public $email = "";
    public $phone_number = "";
    public $type = "";
    public $address_id;
    public $comment;

    #[On('addedCity')]
    public function get_user_addresses() {
        $this->user_addresses = Auth::user()->addresses;
    }

    public function getCart()
    {
        $this->carts = Cart::content()->toArray();
        $this->total = Cart::subtotal();
        $this->totalCount = Cart::count();
    }

    public function mount()
    {
        $this->cities = City::all();
        $this->getCart();

        if (Auth::check()) {
            $this->get_user_addresses();
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
            $this->phone_number = Auth::user()->phone_number;
        }
    }

    public function destroy($id)
    {
        Cart::remove($id);
        $this->getCart();
    }

    public function decrement($rowID, $qty)
    {
        if ($qty > 0) {
            Cart::update($rowID, $qty - 1);
            $this->getCart();
        }
    }

    public function increment($rowID, $qty)
    {
        Cart::update($rowID, $qty + 1);
        $this->getCart();
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'type' => 'required',
        ];

        // Если пользователь не авторизован, добавляем валидацию города и адреса
        if (!Auth::check()) {
            $rules['city'] = 'required';
            $rules['address'] = 'required';
        } else if (Auth::check()) {
            $rules['address_id'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'city.required' => "Поле «Город» обязательно для заполнения",
            'address.required' => "Поле Адрес обязательно для заполнения",
            'name.required' => "Поле «Имя» обязательно для заполнения.",
            'email.required' => "Поле «электронной почты» обязательно.",
            'phone_number.required' => "Поле «Номер телефона» обязательно для заполнения.",
            'type.required' => "Это поле обязательно к заполнению.",
            'address_id.required' => "Выберите адрес.",
        ];
    }


    public function makeVisaPaymentRequest($amount)
    {
        $orderId = rand(10000000, 99999999);

        $timestamp = gmdate('YmdHis');
        $nonce = self::generateRandomHex(32);
        $merchRnId = self::generateRandomHex(16);

        // Важно: порядок полей должен соответствовать документации
        $macFields = [
            'AMOUNT'    => (string) $amount,
            'CURRENCY'  => '398',
            'ORDER'     => (string)$orderId,
            'MERCHANT'  => '00000001',
            'TERMINAL'  => '90033910',
            'MERCH_GMT' => '+6',
            'TIMESTAMP' => $timestamp,
            'TRTYPE'    => '1',
            'NONCE'     => $nonce,
        ];

        $macDataString = '';
        foreach ($macFields as $value) {
            $macDataString .= strlen($value) . $value;
        }

        $secretKeyHex = '699edf9c7c02d5776e84e46d59b74257';
        $binaryKey = hex2bin($secretKeyHex); // Преобразование из HEX в бинарный формат

        // Генерация P_SIGN
        $pSign = strtoupper(hash_hmac('sha1', $macDataString, $binaryKey)); // Вычисление HMAC-SHA1

        // Формирование массива данных для отправки
        $data = array_merge($macFields, [
            'MERCH_RN_ID' => $merchRnId,
            'DESC'        => 'TRTYPE=1 test transaction (Frictionless Flow)',
            'MERCH_NAME'  => 'ИП "CAVIAR"',
            'BACKREF'     => route('visa.result'),
            'LANG'        => 'ru',
            'P_SIGN'      => $pSign,
            'MK_TOKEN'    => 'MERCH',
            'NOTIFY_URL'  => 'https://merchantdomain.kz:443/url/notify/callback',
            'CLIENT_IP'   => request()->ip(),
            'M_INFO'      => base64_encode(json_encode([
                'browserScreenHeight' => '1920',
                'browserScreenWidth'  => '1080',
                'mobilePhone'         => [
                    'cc' => '7',
                    'subscriber' => '7475558888',
                ],
            ])),
        ]);

        $ch = curl_init('https://3dsecure.bcc.kz:5443/cgi-bin/cgi_link');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Данные в формате URL-encoded
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

        $response = curl_exec($ch);
        curl_close($ch);

        Cache::put("visa_payment_$orderId", $response, now()->addMinutes(5));
        return route('visa.payment', ['order' => $orderId]);
    }

    private static function generateRandomHex($length)
    {
        return strtoupper(bin2hex(random_bytes($length / 2)));
    }



public function fetchCart()
{
    $this->validate();

    $address = Auth::check()
        ? "Город: " . City::find(Address::find($this->address_id)->city_id)->name .  ", Адрес: " . Address::find($this->address_id)->address
        : "Город: " . $this->city . ", Адрес: " . $this->address;

    $order = Order::create([
        'name' => $this->name,
        'address' => $address,
        'phone_number' => $this->phone_number,
        'email' => $this->email,
        'comment' => $this->comment,
        'type' => $this->type,
        'total_price' => $this->total,
        'products' => $this->carts,
        'user_id' => Auth::check() ? Auth::user()->id : null
    ]);

    if ($this->type === "Visa") {

		$amount = (int) str_replace([',', '.00'], '', $this->total);

        $paymentUrl = $this->makeVisaPaymentRequest($amount);

        Mail::send('email.order', ['order' => $order], function ($message) {
            $message->to("n4msin@mail.ru")->subject('Заказ');
        });

        Cart::destroy();

        $this->reset([
            'city', 'address', 'name', 'email', 'phone_number', 'type', 'address_id', 'comment', 'carts', 'total', 'totalCount',
        ]);

        $this->getCart();

        return redirect()->away($paymentUrl);
    }

    Mail::send('email.order', ['order' => $order], function ($message) {
        $message->to("n4msin@mail.ru")->subject('Заказ');
    });

    Cart::destroy();

    $this->reset([
        'city', 'address', 'name', 'email', 'phone_number', 'type', 'address_id', 'comment', 'carts', 'total', 'totalCount',
    ]);

    $this->getCart();

    return $this->redirect('/thanks');
}


    public function render()
    {
        return view('livewire.pages.cart-page');
    }
}
