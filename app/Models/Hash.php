<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hash extends Model
{
    public $timestamps = true;

    protected $casts = [
        'input_string' => 'string',
        'key' => 'string',
        'hash' => 'string',
        'attempts' => 'integer'
    ];

    protected $fillable = [
        'input_string',
        'key',
        'hash',
        'attempts'
    ];
}
