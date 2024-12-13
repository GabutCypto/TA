<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Cek apakah pengguna login
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek jika saldo ada
        if ($user->saldo) {
            $saldo = $user->saldo;
        } else {
            $saldo = 0; // Atau nilai default jika saldo tidak ada
        }

        return view('dashboard', compact('user', 'saldo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saldo $saldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        //
    }
}