<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Extend this class
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable // Ensure it extends Authenticatable
{
    use HasFactory;

    // Define the fields that are mass-assignable
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
// Specify the hidden attributes (such as password) when the model is converted to an array or JSON
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Cast the email_verified_at field to a Carbon instance
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}