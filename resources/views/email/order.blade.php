<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новый заказ</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #f8f9fa, #e9ecef);
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #333;
            color: white;
        }
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        .price {
            color: #28a745;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛒 Новый заказ</h1>

        <div class="info">
            <p><strong>👤 Имя:</strong> {{ $order['name'] }}</p>
            <p><strong>📞 Телефон:</strong> {{ $order['phone_number'] }}</p>
            <p><strong>✉️ Email:</strong> {{ $order['email'] }}</p>
            <p><strong>📦 Тип:</strong> {{ $order['type'] }}</p>
            <p><strong>💬 Комментарий:</strong> {{ $order['comment'] ?? 'Нет комментария' }}</p>
            <p class="price"><strong>💰 Общая сумма:</strong> {{ number_format((float) $order['total_price'], 0, ',', ' ') }} KZT</p>
            <p><strong>📍 Адрес:</strong> {{ $order['address'] ?? 'Не указан' }}</p>
            <p><strong>🕒 Дата заказа:</strong> {{ $order['created_at'] ?? now() }}</p>
        </div>

        <h2 style="text-align:center; color:#333;">📋 Список товаров</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order['products'] as $product)
                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td style="text-align:center;">{{ $product['qty'] }}</td>
                            <td class="price">{{ number_format((float) $product['price'], 0, ',', ' ') }} KZT</td>
                            <td class="price">{{ number_format((float) $product['subtotal'], 0, ',', ' ') }} KZT</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="footer">С уважением, <br> <strong>{{ config('app.name') }}</strong></p>
    </div>
</body>
</html>
