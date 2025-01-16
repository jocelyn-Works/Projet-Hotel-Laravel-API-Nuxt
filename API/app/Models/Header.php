<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'Headers';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "image",
        "content",
    ];
}
