<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    protected $table = 'mains';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "image",
        "content",
    ];
}
