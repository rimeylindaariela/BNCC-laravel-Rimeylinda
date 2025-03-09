<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // Add these fields to the $fillable array
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class); // Cart belongs to a single product
    }


}
