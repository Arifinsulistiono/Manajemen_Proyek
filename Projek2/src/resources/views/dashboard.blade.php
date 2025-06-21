@extends('components.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Total Pasien</h2>
        <p class="text-3xl">{{ $totalPasien }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Total Dokter</h2>
        <p class="text-3xl">{{ $totalDokter }}</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Total Obat</h2>
        <p class="text-3xl">{{ $totalObat }}</p>
    </div>
</div>
@endsection
