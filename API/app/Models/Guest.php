<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guests';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        "user_id",
        "first_name",
        "last_name", 
        "email", 
        "phone_number"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
