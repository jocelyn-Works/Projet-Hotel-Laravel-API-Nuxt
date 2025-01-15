<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['id', 'type_id', 'percent', 'start_date', 'end_date',];
}
