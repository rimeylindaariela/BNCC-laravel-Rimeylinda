<h1>Product List</h1>

@foreach($products as $product)
    <div>
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <p>Rp.{{ $product->price }}</p>
        <p>{{ $product->stock }}</p>
        @if ($product->stock === 0)
    <p class="text-danger">Stock's empty</p> 
@endif
        <p><img src="{{ asset('storage/app/private'. $product->picture) }}" alt="Product Image"></p>
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <button type="submit">Add to Cart</button>
        </form>
    </div>
@endforeach