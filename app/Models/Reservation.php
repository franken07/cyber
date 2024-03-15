<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['date', 'start_time','end_time', 'user_name','admin_email','phone','admin_id','admin_name','user_email','status'];
}
