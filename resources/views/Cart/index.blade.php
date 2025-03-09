@foreach ($cartItems as $item)
    <div>
        <p>{{ $item->product->name }} - Quantity: {{ $item->quantity }}</p>
    </div>
@endforeach