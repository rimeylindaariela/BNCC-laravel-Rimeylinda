<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
</head>
<body>
    <h1>Invoice #{{ $invoiceNumber }}</h1>

    <h3>Cart Items:</h3>
    <ul>
        @foreach ($cartItems as $item)
            <li>
                {{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: ${{ $item->product->price }} 
                = ${{ $item->product->price * $item->quantity }}
            </li>
        @endforeach
    </ul>

    <p><strong>Subtotal: ${{ $subtotal }}</strong></p>

    <!-- Form to save the invoice (address, etc.) -->
    <form action="/cart/save-invoice" method="POST">
        @csrf
        <label for="address">Address:</label>
        <input type="text" name="address" required><br><br>

        <label for="postcode">Postcode:</label>
        <input type="text" name="postcode" required><br><br>

        <button type="submit">Save Invoice</button>
    </form>
</body>
</html>