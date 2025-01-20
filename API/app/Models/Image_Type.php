<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Image_Type extends Model
{
    protected $table = 'image_type';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'type_id',
        'image',
    ];

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }


}
