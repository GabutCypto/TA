<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $kategori = Kategori::all();
        return view('admin.kategori.index', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'required|image|mimes:png,jpg,svg,jpeg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('kategori_icon', 'public');
                $validated['icon'] = $iconPath;
            }
            $validated['slug'] = Str::slug($request->nama);

            $newKategori = Kategori::create($validated);

            DB::commit();

            return redirect()->route('admin.kategori.index');
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
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
        return view('admin.kategori.edit', [
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'icon' => 'sometimes|image|mimes:png,jpg,svg,jpeg',
        ]);

        DB::beginTransaction();

        try {
            if ($request->hasFile('icon')) {
                if ($kategori->icon) {
                    Storage::delete('public/' . $kategori->icon);
                }

                $iconPath = $request->file('icon')->store('kate$kategori', 'public');
                $validated['icon'] = $iconPath;
            }

            $validated['slug'] = Str::slug($request->nama);

            $kategori->update($validated);

            DB::commit();

            return redirect()->route('admin.kategori.index');
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
    public function destroy(Kategori $kategori)
    {
        //
        try {
            // Hapus foto kategori dari storage jika ada
            if ($kategori->icon) {
                Storage::delete('public/' . $kategori->icon);
            }

            // Hapus kategori
            $kategori->delete();
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