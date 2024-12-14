<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $santri = Santri::orderBy('id', 'DESC')->take(20)->get();

        return view('admin.santri.index', [
            'santri' => $santri
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.santri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ortu' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'required|image|mimes:png,jpg,svg,jpeg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                $fotoPath = $request->file('foto')->store('foto_santri', 'public');
                $validated['foto'] = $fotoPath;
            }
            $validated['slug'] = Str::slug($request->nama);

            $newProduct = Santri::create($validated);

            DB::commit();

            return redirect()->route('admin.santri.index');
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
    public function show(Santri $santri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Santri $santri)
    {
        //
        return view('admin.santri.edit', [
            'santri' => $santri
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Santri $santri)
    {
        //
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'ortu' => 'required|string',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|mimes:png,jpg,svg,jpeg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('foto')) {
                if ($santri->foto) {
                    Storage::delete('public/' . $santri->foto);
                }

                $fotoPath = $request->file('foto')->store('foto_santri', 'public');
                $validated['foto'] = $fotoPath;
            }

            $validated['slug'] = Str::slug($request->nama);

            $santri->update($validated);

            DB::commit();

            return redirect()->route('admin.santri.index');
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
    public function destroy(Santri $santri)
    {
        //
        try {
            if ($santri->foto) {
                Storage::delete('public/' . $santri->foto);
            }

            $santri->delete();
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