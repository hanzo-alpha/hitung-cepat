<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\KegiatanRequest;
use App\Http\Resources\KegiatanResource;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Kegiatan::class);

        return KegiatanResource::collection(Kegiatan::all());
    }

    public function store(KegiatanRequest $request)
    {
        $this->authorize('create', Kegiatan::class);

        return new KegiatanResource(Kegiatan::create($request->validated()));
    }

    public function show(Kegiatan $kegiatan)
    {
        $this->authorize('view', $kegiatan);

        return new KegiatanResource($kegiatan);
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatan)
    {
        $this->authorize('update', $kegiatan);

        $kegiatan->update($request->validated());

        return new KegiatanResource($kegiatan);
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $this->authorize('delete', $kegiatan);

        $kegiatan->delete();

        return response()->json();
    }
}
