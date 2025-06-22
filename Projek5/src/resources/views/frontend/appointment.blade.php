@extends('layouts.app')

@section('title', 'Appointment | Klinik SehatLah')

@push('assets')
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/klinik/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/klinik/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/css/style.css') }}" rel="stylesheet">

    <!-- Font Awesome & Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Appointment</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Appointment</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Appointment</p>
                    <h1 class="mb-4">Buat Janji Temu di Klinik SehatLah</h1>
                    <p class="mb-4">Silakan isi formulir di samping untuk membuat janji dengan dokter kami. Kami siap melayani Anda dengan sepenuh hati.</p>
                    <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Call Us Now</p>
                            <h5 class="mb-0">+62 2345 6789</h5>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Mail Us Now</p>
                            <h5 class="mb-0">kliniksehatlah@gmail.com</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form action="{{ route('appointment.store') }}" method="POST" class="w-100">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="nama" class="form-control border-0 @error('nama') is-invalid @enderror" placeholder="Nama Lengkap" value="{{ old('nama') }}" required style="height: 55px;">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0 @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required style="height: 55px;">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="mobile" class="form-control border-0 @error('mobile') is-invalid @enderror" placeholder="No. Telepon" value="{{ old('mobile') }}" required style="height: 55px;">
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="date" name="date" class="form-control border-0 @error('date') is-invalid @enderror" value="{{ old('date') }}" required style="height: 55px;">
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="time" name="time" class="form-control border-0 @error('time') is-invalid @enderror" value="{{ old('time') }}" required style="height: 55px;">
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tambahkan dropdown dokter -->
                                <div class="col-12 col-sm-6">
                                    <select name="dokter_id" class="form-select border-0 @error('dokter_id') is-invalid @enderror" required style="height: 55px;">
                                        <option value="" disabled selected>Pilih Dokter</option>
                                        @foreach ($dokters as $dokter)
                                            <option value="{{ $dokter->id }}" {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>
                                                {{ $dokter->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dokter_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Booking Sekarang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
@endsection
