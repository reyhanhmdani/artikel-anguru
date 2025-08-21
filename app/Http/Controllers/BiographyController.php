<?php

namespace App\Http\Controllers;

use App\Http\Requests\BiographyRequest;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiographyController extends Controller
{
    public function manage()
    {
        $biography = Biography::first();
        return view('admin.biography.manage', compact('biography'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function storeOrUpdate(BiographyRequest $request)
    {
        $validatedData = $request->validated();

        $biography = Biography::first();
          // Handle file upload
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($biography && $biography->profile_picture) {
                Storage::disk('public')->delete($biography->profile_picture);
            }
            $validatedData['profile_picture'] = $request->file('profile_picture')->store('biography', 'public');
        }

        // Simpan atau perbarui data
        if ($biography) {
            $biography->update($validatedData);
            $message = 'Biografi berhasil diperbarui!';
        } else {
            Biography::create($validatedData);
            $message = 'Biografi berhasil dibuat!';
        }

        return redirect()->route('admin.biography.manage')->with('success', $message);

    }

    /**
     * Display the specified resource.
     */
    public function show(biography $biography)
    {
    $biography = Biography::first();


    if (!$biography) {
        return view('public.biography', ['biography' => null]);
    }

    return view('public.biography', compact('biography'));
    }

}
