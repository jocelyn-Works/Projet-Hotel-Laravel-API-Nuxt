<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price'
    ];

    public function imageTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Image_Type::class, 'type_id', 'id');
    }

}
