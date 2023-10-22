<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RelawanRequest;
use App\Http\Resources\RelawanResource;
use App\Models\Relawan;

class RelawanController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Relawan::class);

        return RelawanResource::collection(Relawan::all());
    }

    public function store(RelawanRequest $request)
    {
        $this->authorize('create', Relawan::class);

        return new RelawanResource(Relawan::create($request->validated()));
    }

    public function show(Relawan $relawan)
    {
        $this->authorize('view', $relawan);

        return new RelawanResource($relawan);
    }

    public function update(RelawanRequest $request, Relawan $relawan)
    {
        $this->authorize('update', $relawan);

        $relawan->update($request->validated());

        return new RelawanResource($relawan);
    }

    public function destroy(Relawan $relawan)
    {
        $this->authorize('delete', $relawan);

        $relawan->delete();

        return response()->json();
    }
}
