<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>

    <ul>
        @foreach ($cartItems as $item)
            <li>
                {{ $item->product->name }} - ${{ $item->product->price }} x {{ $item->quantity }}
            </li>
        @endforeach
    </ul>

    <a href="{{ route('cart.generateInvoice') }}">Generate Invoice</a>
</body>
</html>