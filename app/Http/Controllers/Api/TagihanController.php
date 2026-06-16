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
            'imageId' => 'nullable|string'
        ]);

        $tagihan = Tagihan::create($validated);
        return response()->json($tagihan, 201);
    }
}