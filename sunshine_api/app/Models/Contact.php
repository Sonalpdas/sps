<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'reason'];
}