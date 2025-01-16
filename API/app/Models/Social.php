<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $table = 'socials';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "icon",
        "url",


    ];
}
