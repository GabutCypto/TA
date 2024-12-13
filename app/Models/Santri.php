<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function bayar()
    {
        return $this->hasMany(Bayar_sumbangan::class);
    }

    public function topup()
    {
        return $this->hasMany(Topup::class);
    }
}