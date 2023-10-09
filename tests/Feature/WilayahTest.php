<?php

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Provinsi;
use App\Models\Pulau;
use Illuminate\Database\Eloquent\Collection;

it('can get a provinsi', function () {
    expect(Provinsi::first())->not->toBeEmpty();

    $provinsi = Provinsi::find(33);
    expect($provinsi->code)->toBe(33)
        ->and($provinsi->name)->toBe('JAWA TENGAH');
});

it('can get provinsi model relations', function () {
    $kabupaten = Provinsi::find(33)->kabupaten;

    expect($kabupaten)->toBeInstanceOf(Collection::class)
        ->and($kabupaten->count())->toBe(35)
        ->and($kabupaten->first()->code)->toBe(3301)
        ->and($kabupaten->first()->name)->toBe('KAB. CILACAP')
        ->and($kabupaten->last()->code)->toBe(3376)
        ->and($kabupaten->last()->name)->toBe('KOTA TEGAL');

    $kecamatan = Provinsi::find(33)->kecamatan;
    expect($kecamatan)->toBeInstanceOf(Collection::class)
        ->and($kecamatan->count())->toBe(576)
        ->and($kecamatan->first()->code)->toBe(330101)
        ->and($kecamatan->first()->name)->toBe('Kedungreja')
        ->and($kecamatan->last()->code)->toBe(337604)
        ->and($kecamatan->last()->name)->toBe('Margadana');

    $villlages = Provinsi::find(33)->kelurahan;
    expect($villlages)->toBeInstanceOf(Collection::class)
        ->and($villlages->count())->toBe(8563)
        ->and($villlages->first()->code)->toBe(3301012001)
        ->and($villlages->first()->name)->toBe('Tambakreja')
        ->and($villlages->last()->code)->toBe(3376041007)
        ->and($villlages->last()->name)->toBe('Pesurungan Lor');

    $pulau = Provinsi::find(33)->pulau;
    expect($pulau)->toBeInstanceOf(Collection::class)
        ->and($pulau->count())->toBe(71)
        ->and($pulau->first()->code)->toBe(40001)
        ->and($pulau->first()->name)->toBe('Nusa Bagian')
        ->and($pulau->last()->code)->toBe(40032)
        ->and($pulau->last()->name)->toBe('Pulau Tengah');
});

it('can get a kabupaten', function () {
    expect(Kabupaten::first())->not->toBeEmpty();

    $kabupaten = Kabupaten::find(3374);
    expect($kabupaten->code)->toBe(3374)
        ->and($kabupaten->name)->toBe('KOTA SEMARANG');
});

it('can get kabupaten model relations', function () {
    $provinsi = Kabupaten::find(3374)->provinsi;
    expect($provinsi)->toBeInstanceOf(Provinsi::class)
        ->and($provinsi->code)->toBe(33)
        ->and($provinsi->name)->toBe('JAWA TENGAH');

    $kecamatan = Kabupaten::find(3374)->kecamatan;
    expect($kecamatan)->toBeInstanceOf(Collection::class)
        ->and($kecamatan->count())->toBe(16)
        ->and($kecamatan->first()->code)->toBe(337401)
        ->and($kecamatan->first()->name)->toBe('Semarang Tengah')
        ->and($kecamatan->last()->code)->toBe(337416)
        ->and($kecamatan->last()->name)->toBe('Tugu');

    $kabupaten = Kabupaten::find(3374)->kelurahan;
    expect($kabupaten)->toBeInstanceOf(Collection::class)
        ->and($kabupaten->count())->toBe(177)
        ->and($kabupaten->first()->code)->toBe(3374011001)
        ->and($kabupaten->first()->name)->toBe('Miroto')
        ->and($kabupaten->last()->code)->toBe(3374161007)
        ->and($kabupaten->last()->name)->toBe('Mangunharjo');

    $pulau = Kabupaten::find(1504)->pulau;
    expect($pulau)->toBeInstanceOf(Collection::class)
        ->and($pulau->count())->toBe(2)
        ->and($pulau->first()->code)->toBe(40001)
        ->and($pulau->first()->name)->toBe('Pulau Selat')
        ->and($pulau->last()->code)->toBe(40002)
        ->and($pulau->last()->name)->toBe('Pulau Senaning');
});

it('can get a kecamatan', function () {
    expect(Kecamatan::first())->not->toBeEmpty();
    $kecamatan = Kecamatan::find(337401);
    expect($kecamatan->code)->toBe(337401)
        ->and($kecamatan->name)->toBe('Semarang Tengah');
});

it('can get kecamatan model relations', function () {
    $provinsi = Kecamatan::find(337401)->provinsi;
    expect($provinsi)->toBeInstanceOf(Provinsi::class)
        ->and($provinsi->code)->toBe(33)
        ->and($provinsi->name)->toBe('JAWA TENGAH');

    $kabupaten = Kecamatan::find(337401)->kabupaten;
    expect($kabupaten)->toBeInstanceOf(Kabupaten::class)
        ->and($kabupaten->code)->toBe(3374)
        ->and($kabupaten->name)->toBe('KOTA SEMARANG');

    $villlages = Kecamatan::find(337401)->kelurahan;
    expect($villlages)->toBeInstanceOf(Collection::class)
        ->and($villlages->count())->toBe(15)
        ->and($villlages->first()->code)->toBe(3374011001)
        ->and($villlages->first()->name)->toBe('Miroto')
        ->and($villlages->last()->code)->toBe(3374011015)
        ->and($villlages->last()->name)->toBe('Pindrikan Lor');
});

it('can get a village', function () {
    expect(Kelurahan::first())->not->toBeEmpty();

    $village = Kelurahan::find(3374011001);
    expect($village->code)->toBe(3374011001)
        ->and($village->name)->toBe('Miroto');
});

it('can get village model relations', function () {
    $provinsi = Kelurahan::find(3374011001)->provinsi;
    expect($provinsi)->toBeInstanceOf(Provinsi::class)
        ->and($provinsi->code)->toBe(33)
        ->and($provinsi->name)->toBe('JAWA TENGAH');

    $kabupaten = Kelurahan::find(3374011001)->kabupaten;
    expect($kabupaten)->toBeInstanceOf(Kabupaten::class)
        ->and($kabupaten->code)->toBe(3374)
        ->and($kabupaten->name)->toBe('KOTA SEMARANG');

    $kecamatan = Kelurahan::find(3374011001)->kecamatan;
    expect($kecamatan)->toBeInstanceOf(Kecamatan::class)
        ->and($kecamatan->code)->toBe(337401)
        ->and($kecamatan->name)->toBe('Semarang Tengah');
});

it('can get a island', function () {
    expect(Pulau::first())->not->toBeEmpty();

    $provinsi = Pulau::find(40020);
    expect($provinsi->code)->toBe(40020)
        ->and($provinsi->name)->toBe('Pulau Burok');
});

it('can get island model relations', function () {
    $provinsi = Pulau::find(40020)->provinsi;
    expect($provinsi)->toBeInstanceOf(Provinsi::class)
        ->and($provinsi->code)->toBe(11)
        ->and($provinsi->name)->toBe('ACEH');

    $kabupaten = Pulau::find(40020)->kabupaten;
    expect($kabupaten)->toBeInstanceOf(Kabupaten::class)
        ->and($kabupaten->code)->toBe(1106)
        ->and($kabupaten->name)->toBe('KAB. ACEH BESAR');

    $kecamatan = Pulau::find(40020)->kecamatan;
    expect($kecamatan)->toBeInstanceOf(Kecamatan::class)
        ->and($kecamatan->code)->toBe(110601)
        ->and($kecamatan->name)->toBe('Lhoong');
});

it('can get new kecamatan added in v2', function () {
    $kecamatan = Kecamatan::find(110115);
    expect($kecamatan->code)->toBe(110115)
        ->and($kecamatan->name)->toBe('Bakongan Timur');

    $kecamatan = Kecamatan::find(930423);
    expect($kecamatan->code)->toBe(930423)
        ->and($kecamatan->name)->toBe('Koroway Buluanop');
});

it('can get new kelurahan added in v2', function () {
    $village = Kelurahan::find(1207212002);
    expect($village->code)->toBe(1207212002)
        ->and($village->name)->toBe('Patumbak I');

    $village = Kelurahan::find(9201502009);
    expect($village->code)->toBe(9201502009)
        ->and($village->name)->toBe('Mlaron');
});

it('can test new data for v2.0.2', function () {
    $kecamatan = Kecamatan::find(331710);
    expect($kecamatan->code)->toBe(331710)
        ->and($kecamatan->name)->toBe('Rembang');
});
