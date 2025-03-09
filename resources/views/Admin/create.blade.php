<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
    <h1>Create New Product</h1>
    
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required><br><br>

        <label for="name">Product Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br>
<label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required><br><br>

        <label for="picture">Product Image:</label>
        <input type="file" name="picture" id="picture" required><br><br>

        <button type="submit">Create Product</button>
    </form>
</body>
</html>