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
            $validated['imageId'] = pathinfo($fileName, PATHINFO_FILENAME); 
        }

        $tagihan = Tagihan::create($validated);
        return response()->json(['status' => 'success', 'data' => $tagihan], 201);
    }
    public function softDelete($id)
    {
        $tagihan = Tagihan::find($id);
        if ($tagihan) {
            $tagihan->isDeleted = true; 
            $tagihan->save();
            return response()->json(['status' => 'success', 'message' => 'Masuk ke Recycle Bin']);
        }
        return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
    }

    public function update(Request $request, $id)
    {
        $tagihan = Tagihan::find($id);
        if (!$tagihan) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'namaTagihan' => 'required|string',
            'totalTagihan' => 'required|numeric',
            'jumlahOrang' => 'required|integer',
            'pakaiPajak' => 'required|boolean',
            'persentasePajak' => 'required|numeric',
            'hasilPerOrang' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
            $validated['imageId'] = pathinfo($fileName, PATHINFO_FILENAME);
        }

        $tagihan->update($validated);

        return response()->json(['status' => 'success', 'data' => $tagihan], 200);
    }
}