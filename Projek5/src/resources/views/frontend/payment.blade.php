@extends('layouts.app')

@section('title', 'Payment | Klinik SehatLah')

@section('content')
<div class="container my-5">
    <h2 class="text-center text-primary fw-bold">Cek dan Bayar Tagihan</h2>
    <p class="text-center text-muted mb-4">Masukkan email Anda untuk melihat detail tagihan kunjungan</p>

    @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif
    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    @if(!isset($appointments))
        <form action="{{ route('appointment.payment.email') }}" method="POST" class="card p-4 shadow-sm">
            @csrf
            <div class="mb-3">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Lihat Tagihan</button>
        </form>
    @else
        <h4 class="mb-3">Daftar Janji Temu Anda</h4>
        @foreach($appointments as $appointment)
            @php
                $obats = $appointment->diagnosa->resep->obats ?? collect();
                $hargaObat = $obats->sum('harga');
                $hargaJasa = $appointment->dokter->harga_jasa ?? 0;
                $total = $hargaObat + $hargaJasa;
                $transaction = $appointment->transaction;
            @endphp

            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between">
                    <strong><i class="bi bi-receipt"></i> {{ $appointment->date }} - {{ $appointment->time }}</strong>
                    <span class="badge bg-{{ $transaction->status == 'Lunas' ? 'success' : 'danger' }}">{{ $transaction->status }}</span>
                </div>
                <div class="card-body">
                    <p>Nama Pasien: <strong>{{ $appointment->nama }}</strong></p>
                    <p>Jasa Dokter: Rp {{ number_format($hargaJasa, 0, ',', '.') }}</p>
                    <p>Obat:
                        @forelse($obats as $obat)
                            <span class="badge bg-info text-dark">{{ $obat->nama }}</span>
                        @empty
                            <em>Tidak ada</em>
                        @endforelse
                    </p>
                    <p>Harga Obat: Rp {{ number_format($hargaObat, 0, ',', '.') }}</p>
                    <p>Total Tagihan: <strong class="text-danger">Rp {{ number_format($total, 0, ',', '.') }}</strong></p>

                    @if($transaction->status == 'Belum Lunas')
                        <button class="btn btn-outline-success" type="button" data-bs-toggle="collapse" data-bs-target="#pay-{{ $appointment->id }}">
                            Bayar Sekarang
                        </button>
                        <div class="collapse mt-3" id="pay-{{ $appointment->id }}">
                            <form action="{{ route('appointment.pay', $appointment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label>Metode Pembayaran</label>
                                    <select name="payment_method" class="form-select payment-method" data-id="{{ $appointment->id }}" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="BCA">Transfer BCA</option>
                                        <option value="MANDIRI">Transfer Mandiri</option>
                                        <option value="DANA">Dana</option>
                                    </select>
                                </div>

                                <div class="mb-2" id="rekeningInfo-{{ $appointment->id }}" style="display: none;">
                                    <div class="alert alert-info">
                                        <strong>Transfer ke:</strong><br>
                                        <span id="namaBank-{{ $appointment->id }}"></span><br>
                                        <span id="noRek-{{ $appointment->id }}"></span><br>
                                        <span id="atasNama-{{ $appointment->id }}"></span>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <label>Upload Bukti Pembayaran</label>
                                    <input type="file" name="bukti_pembayaran" class="form-control">
                                </div>
                                <button class="btn btn-success">Bayar & Cetak Invoice</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('appointment.payment.invoice', $appointment->id) }}" class="btn btn-secondary">
                            Download Invoice
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@push('scripts')
@if(isset($appointments))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dataRekening = {
            BCA: {
                bank: 'Bank BCA',
                norek: '1234567890',
                nama: 'Klinik SehatLah'
            },
            MANDIRI: {
                bank: 'Bank Mandiri',
                norek: '9876543210',
                nama: 'Klinik SehatLah'
            },
            DANA: {
                bank: 'Dana eWallet',
                norek: '081234567890',
                nama: 'Klinik SehatLah'
            }
        };

        function updateRekeningInfo(select) {
            const id = select.dataset.id;
            const val = select.value;
            const rekeningInfo = document.getElementById('rekeningInfo-' + id);
            const bank = document.getElementById('namaBank-' + id);
            const norek = document.getElementById('noRek-' + id);
            const atasnama = document.getElementById('atasNama-' + id);

            if (dataRekening[val]) {
                rekeningInfo.style.display = 'block';
                bank.textContent = 'Metode: ' + dataRekening[val].bank;
                norek.textContent = 'No: ' + dataRekening[val].norek;
                atasnama.textContent = 'Atas Nama: ' + dataRekening[val].nama;
            } else {
                rekeningInfo.style.display = 'none';
            }
        }

        // Attach listener to all selects
        document.querySelectorAll('.payment-method').forEach(select => {
            select.addEventListener('change', function () {
                updateRekeningInfo(this);
            });

            // If already selected (for page reload or collapse open), trigger once
            if (select.value) {
                updateRekeningInfo(select);
            }
        });

        // Optional: Update info when collapse is shown (Bootstrap 5 event)
        document.querySelectorAll('.collapse').forEach(collapseEl => {
            collapseEl.addEventListener('shown.bs.collapse', function () {
                const select = this.querySelector('.payment-method');
                if (select) updateRekeningInfo(select);
            });
        });
    });
</script>
@endif
@endpush