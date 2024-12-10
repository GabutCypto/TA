<?php

namespace App\Http\Controllers;

use App\Models\Sumbangan;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SumbanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sumbangan = Sumbangan::all();
        return view('admin.sumbangan.index', [
            'sumbangan' => $sumbangan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.sumbangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $newSumbangan = Sumbangan::create($validated);

            DB::commit();

            return redirect()->route('admin.sumbangan.index');
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
    public function show(Sumbangan $sumbangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sumbangan $sumbangan)
    {
        //
        return view('admin.sumbangan.edit', [
            'sumbangan' => $sumbangan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sumbangan $sumbangan)
    {
        //
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $sumbangan->update($validated);

            DB::commit();

            return redirect()->route('admin.sumbangan.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sumbangan $sumbangan)
    {
        //
        try {
            $sumbangan->delete();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}