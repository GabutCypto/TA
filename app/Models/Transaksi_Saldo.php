<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi_Saldo extends Model
{
    //

    protected $guarded = [
        'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function santri(){
        return $this->belongsTo(Santri::class);
    }
}