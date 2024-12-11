<?php

namespace App\Http\Controllers;

use App\Models\Bayar_sumbangan;
use App\Models\Santri;
use App\Models\Sumbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BayarSumbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        if($user->hasRole('buyer')){
            $bayar_sumbangan = $user->bayarSumbangan()->with(['santri', 'sumbangan'])->orderBy('id', 'DESC')->get();
        }
        else{
            $bayar_sumbangan = Bayar_sumbangan::with(['santri', 'sumbangan'])->orderBy('id', 'DESC')->get();
        }
        
        return view('admin.bayar.index', [
            'bayar_sumbangan' => $bayar_sumbangan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $santri = Santri::all();
        $sumbangan = Sumbangan::all();
        return view('user.bayar_sumbangan.create', [
            'santri' => $santri,
            'sumbangan' => $sumbangan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $user = Auth::user();

        $validated = $request->validate([
            'santri_id' => 'required|integer',
            'sumbangan_id' => 'required|integer',
            'bukti' => 'required|image|mimes:png,jpg,svg,jpeg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('bukti')) {
                $buktiPath = $request->file('bukti')->store('bayar_sumbangan', 'public');
                $validated['bukti'] = $buktiPath;
            }

            $validated['user_id'] = $user->id;
            $validated['dibayar'] = false;

            $newBayar = Bayar_sumbangan::create($validated);

            DB::commit();

            return redirect()->route('bayar_sumbangan.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bayar_sumbangan $bayar_sumbangan)
    {
        //
        $bayar_sumbangan = Bayar_sumbangan::with(['santri', 'sumbangan'])->findOrFail($bayar_sumbangan->id);

        return view('admin.bayar.show', compact('bayar_sumbangan'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bayar_sumbangan $bayar_sumbangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bayar_sumbangan $bayar_sumbangan)
    {
        //
        $bayar_sumbangan->update([
            'dibayar' => true,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bayar_sumbangan $bayar_sumbangan)
    {
        //
    }
}