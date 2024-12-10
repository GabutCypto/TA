<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sumbangan extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function bayar()
    {
        return $this->hasMany(Bayar_sumbangan::class);
    }
}