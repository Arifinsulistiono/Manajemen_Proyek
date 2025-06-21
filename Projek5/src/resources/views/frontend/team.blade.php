@extends('layouts.app')

@section('title', 'Team | Klinik SehatLah')

@push('assets')
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/klinik/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/klinik/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Doctors</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Doctors</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Doctors</p>
                <h1>Our Experienced Doctors</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @php
                    $socialMedia = [
                        'Dr. Putra Daffa' => [
                            'instagram' => 'https://www.instagram.com/putradaffad',
                            'github' => 'https://github.com/putradaffad',
                        ],
                        'Dr. Rizky Dwi' => [
                            'instagram' => 'https://www.instagram.com/rizkydnz',
                            'github' => 'https://github.com/rizkydnz',
                        ],
                        'Dr. Muhammad Arifin' => [
                            'instagram' => 'https://www.instagram.com/arifin.sulistiono',
                            'github' => 'https://github.com/arifinsulistiono',
                        ],
                    ];
                @endphp

                @foreach ($doctors as $index => $doctor)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 + $index * 0.2 }}s">
                        <div class="team-item position-relative rounded overflow-hidden">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset($doctor->foto) }}" alt="{{ $doctor->nama }}">
                            </div>
                            <div class="team-text bg-light text-center p-4">
                                <h5>{{ $doctor->nama }}</h5>
                                <p class="text-primary">{{ $doctor->spesialis }}</p>
                                <div class="team-social text-center">
                                    @if (isset($socialMedia[$doctor->nama]['instagram']))
                                        <a class="btn btn-square" href="{{ $socialMedia[$doctor->nama]['instagram'] }}" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if (isset($socialMedia[$doctor->nama]['github']))
                                        <a class="btn btn-square" href="{{ $socialMedia[$doctor->nama]['github'] }}" target="_blank">
                                            <i class="fab fa-github"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/klinik/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/klinik/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/klinik/js/main.js') }}"></script>
@endsection
