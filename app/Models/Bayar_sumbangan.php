<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bayar_sumbangan extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function santri(){
        return $this->belongsTo(Santri::class);
    }

    public function sumbangan(){
        return $this->belongsTo(Sumbangan::class);
    }
}