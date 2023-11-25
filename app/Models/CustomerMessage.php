<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'timestamp_utc',
        'message_body',
    ];
}
