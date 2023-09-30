<?php

use App\Filament\Resources\PartaiResource;
use App\Models\Partai;

use function Pest\Livewire\livewire;

it('can render page', function () {
    $this->get(PartaiResource::getUrl('index'))->assertSuccessful();
});

it('can list partai', function () {
    $posts = Partai::factory()->count(10)->create();

    livewire(PartaiResource\Pages\ManagePartais::class)
        ->assertCanSeeTableRecords($posts);
});
