<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::where('isDeleted', false)->get();
        return response()->json($tagihan);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'namaTagihan' => 'required|string',
        'totalTagihan' => 'required|numeric',
        'jumlahOrang' => 'required|integer',
        'pakaiPajak' => 'required|boolean',
        'persentasePajak' => 'required|numeric',
        'hasilPerOrang' => 'required|numeric',
        'tanggalDibuat' => 'required|string',
        'image' => 'required|image|mimes:jpeg,png,jpg|max:2048' // Validasi file gambar
    ]);

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
        $validated['imageId'] = pathinfo($fileName, PATHINFO_FILENAME); // Simpan nama file tanpa ekstensi ke imageId
    }

    $tagihan = Tagihan::create($validated);
    return response()->json(['status' => 'success', 'data' => $tagihan], 201);
}
}