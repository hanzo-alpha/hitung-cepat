<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ImportDaftarPemilih;
use Illuminate\Http\Request;

class ImportDaftarPemilihController extends Controller
{
    public function index()
    {
        return ImportDaftarPemilih::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'provinsi' => ['nullable'],
            'kabupaten' => ['nullable'],
            'jumlah_kecamatan' => ['nullable', 'integer'],
            'jumlah_kelurahan' => ['nullable', 'integer'],
            'jumlah_tps' => ['nullable', 'integer'],
            'jumlah_laki' => ['nullable', 'integer'],
            'jumlah_perempuan' => ['nullable', 'integer'],
            'total_pemilih' => ['nullable', 'integer'],
            'status_import' => ['nullable', 'integer'],
        ]);

        return ImportDaftarPemilih::create($request->validated());
    }

    public function show(ImportDaftarPemilih $importDaftarPemilih)
    {
        return $importDaftarPemilih;
    }

    public function update(Request $request, ImportDaftarPemilih $importDaftarPemilih)
    {
        $request->validate([
            'provinsi' => ['nullable'],
            'kabupaten' => ['nullable'],
            'jumlah_kecamatan' => ['nullable', 'integer'],
            'jumlah_kelurahan' => ['nullable', 'integer'],
            'jumlah_tps' => ['nullable', 'integer'],
            'jumlah_laki' => ['nullable', 'integer'],
            'jumlah_perempuan' => ['nullable', 'integer'],
            'total_pemilih' => ['nullable', 'integer'],
            'status_import' => ['nullable', 'integer'],
        ]);

        $importDaftarPemilih->update($request->validated());

        return $importDaftarPemilih;
    }

    public function destroy(ImportDaftarPemilih $importDaftarPemilih)
    {
        $importDaftarPemilih->delete();

        return response()->json();
    }
}
