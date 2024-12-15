<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}