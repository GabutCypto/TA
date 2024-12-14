<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Transaksi_Saldo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class TransaksiSaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $user = Auth::user();

    if ($user->hasRole('buyer')) {
        // Filter transaksi hanya untuk user yang sedang login, dengan relasi ke 'santri'
        $transaksiSaldo = Transaksi_Saldo::where('user_id', $user->id)
                                         ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu terbaru
                                         ->take(10) // Ambil hanya 10 transaksi
                                         ->get();
    } else {
        // Tampilkan semua transaksi saldo yang diurutkan berdasarkan 'created_at' terbaru dan ambil 10 transaksi
        $transaksiSaldo = Transaksi_Saldo::orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu terbaru
                                         ->take(10) // Ambil hanya 10 transaksi
                                         ->get();
    }

    return view('admin.transaksisaldo.index', compact('transaksiSaldo'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.transaksisaldo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'user_id' => 'required|exists:users,id',        // Memastikan user_id ada di tabel users
        'santri_id' => 'required|exists:santris,id',    // Memastikan santri_id ada di tabel santris
        'jumlah' => 'required|numeric|min:0.01',         // Memastikan jumlah saldo valid
        'keterangan' => 'required|string|max:255',       // Memastikan keterangan valid
    ]);

    // Ambil saldo user yang sesuai
    $saldo = Saldo::where('user_id', $request->user_id)->first();

    // Cek apakah saldo cukup untuk transaksi
    if (!$saldo || $saldo->saldo < $request->jumlah) {
        return redirect()->route('transaksisaldo.create')->with('error', 'Saldo tidak mencukupi.');
    }

    // Kurangi saldo
    $saldo->saldo -= $request->jumlah;
    $saldo->save();

    // Simpan transaksi saldo ke tabel transaksi__saldos
    Transaksi_Saldo::create([
        'user_id' => $request->user_id,          // Menyimpan user_id
        'santri_id' => $request->santri_id,      // Menyimpan santri_id
        'jumlah' => $request->jumlah,            // Menyimpan jumlah
        'keterangan' => $request->keterangan,    // Menyimpan keterangan
    ]);

    // Redirect setelah berhasil
    return redirect()->route('transaksisaldo.index')->with('success', 'Transaksi berhasil disimpan dan saldo telah dikurangi.');
}
    /**
     * Display the specified resource.
     */
    public function show(Transaksi_Saldo $transaksi_Saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi_Saldo $transaksi_Saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi_Saldo $transaksi_Saldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi_Saldo $transaksi_Saldo)
    {
        //
    }
}