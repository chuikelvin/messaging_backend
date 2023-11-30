<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseChat extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'message', 'timestamp_utc', 'responder_id'];

    public function customerMessage()
    {
        return $this->belongsTo(CustomerMessage::class, 'customer_id', 'customer_id');
    }
}
