<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Topup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user();

        if ($user->hasRole('buyer')) {
            $topup = $user->topup()->with(['santri'])->orderBy('id', 'DESC')->get();
        } else {
            $topup = Topup::with(['user', 'santri'])->orderBy('id', 'DESC')->get();
        }

        return view('admin.topup.index', [
            'topup' => $topup
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $santri = Santri::all();

        return view('admin.topup.create', [
            'santri' => $santri,
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
            'jumlah' => 'required|integer|min:1000',
            'keterangan' => 'required|string',
            'bukti' => 'required|image|mimes:png,jpg,svg,jpeg|max:10240',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('bukti')) {
                $buktiPath = $request->file('bukti')->store('tupup', 'public');
                $validated['bukti'] = $buktiPath;
            }

            $validated['user_id'] = $user->id;
            $validated['dibayar'] = false;

            $newTopup = Topup::create($validated);

            DB::commit();

            return redirect()->route('admin.topup.index');
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
    public function show(Topup $topup)
    {
        //
        $topup->load(['user', 'santri']); // Memuat relasi user dan santri

        return view('admin.topup.show', [
            'topup' => $topup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topup $topup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topup $topup)
    {
        //
        $topup->update([
            'dibayar' => true,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topup $topup)
    {
        //
    }
}