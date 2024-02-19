<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usercommerce extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

}
