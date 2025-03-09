<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')  <!-- Use PUT for update -->
        
        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required><br><br>
<label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="{{ old('category', $product->category) }}" required><br><br>

        <label for="picture">Product Image:</label>
        <input type="file" name="picture" id="picture"><br><br>

        <button type="submit">Update Product</button>
</form>

    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="margin-top: 20px;">
        @csrf
        @method('DELETE')  <!-- Use DELETE for destroy -->
        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete Product</button>
    </form>
</body>
</html>