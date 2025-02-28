<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'guest_id',
        'room_id',
        'start_date',
        'end_date',
        'quantity',
        'payment_method',
        'payment_status',
        'status',
        'created_at',
        'updated_at',
        'qr_code',
        'is_all_inclusive',
        'licence_plate',
        'name',
        'cost',
        'area',
        ];
}
