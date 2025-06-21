@extends('layouts.app')

@section('title', 'Pembayaran | Klinik Bersama')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Pembayaran Appointment</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <strong>Detail Appointment</strong>
        </div>
        <div class="card-body">
            <p><strong>Nama Pasien:</strong> {{ $appointment->name }}</p>
            <p><strong>Dokter:</strong> {{ $appointment->doctor }}</p>
            <p><strong>Tanggal & Waktu:</strong> {{ $appointment->date }} {{ $appointment->time }}</p>
            <p><strong>Keluhan:</strong> {{ $appointment->message }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Detail Transaksi</strong>
        </div>
        <div class="card-body">
            <p><strong>Kode Invoice:</strong> {{ $transaction->invoice_code }}</p>
            <p><strong>Tagihan:</strong> Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
            <p><strong>Status:</strong>
                @if($transaction->status == 'paid')
                    <span class="badge bg-success">Lunas</span>
                @else
                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                @endif
            </p>
        </div>
    </div>

    @if($transaction->status != 'paid')
        <form action="{{ route('appointment.pay', $appointment->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary w-100 py-2">Bayar Sekarang</button>
        </form>
    @else
        <div class="alert alert-success text-center">Terima kasih! Pembayaran Anda telah diterima.</div>
    @endif
</div>
@endsection
