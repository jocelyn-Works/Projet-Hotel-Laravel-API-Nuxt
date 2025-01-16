<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "name",
        "street",
        "city",
        "phone_number",
        "email",
    ];


}
