<?php

namespace App\Http\Controllers;

use App\Models\Bayar_sumbangan;
use App\Models\Santri;
use App\Models\Sumbangan;
use Illuminate\Routing\Controller;

class ListSantriBayarController extends Controller
{
    //
    public function index(){
        $sumbangan = Sumbangan::all();

        return view('admin.bayar.list', [
            'sumbangan' => $sumbangan,
        ]);
    }
}