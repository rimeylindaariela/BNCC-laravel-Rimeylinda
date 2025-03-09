<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // Add these fields to the $fillable array
    protected $fillable = ['user_id','invoice_number','total'];

    
    

}