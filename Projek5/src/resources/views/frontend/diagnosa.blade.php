@extends('layouts.app')

@section('title', 'Input Diagnosa | Klinik SehatLah')

@push('assets')
    <link href="{{ asset('assets/klinik/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/css/style.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Header -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Input Diagnosa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item text-primary active" aria-current="page">Diagnosa</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Form Diagnosa -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-light rounded p-4">
                    <form action="{{ route('diagnosa.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="appointment_id" class="form-label">Pilih Pasien (Appointment)</label>
                            <select name="appointment_id" class="form-control" required>
                                <option value="">-- Pilih Pasien --</option>
                                @foreach ($appointments as $appointment)
                                    <option value="{{ $appointment->id }}">
                                        {{ $appointment->nama }} - {{ $appointment->date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="keluhan" class="form-label">Keluhan</label>
                            <textarea name="keluhan" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status Diagnosa</label>
                            <textarea name="status" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Diagnosa</button>
                    </form>
