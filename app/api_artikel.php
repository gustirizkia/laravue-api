<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class api_artikel extends Model
{
    protected $fillable = [
        'judul', 'konten'
    ];
}
