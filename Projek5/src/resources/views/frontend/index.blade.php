@extends('layouts.app')

@section('title', 'Home | Klinik SehatLah')

@push('assets')
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/klinik/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/klinik/lib/owlcarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
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
    <!-- Header Start -->
    <div class="container-fluid header bg-primary p-0 mb-5">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">Good Health Is The Root Of All Happiness</h1>
                <div class="row g-4">
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">3</h2>
                            <p class="text-light mb-0">Expert Doctors</p>
                        </div>
                    </div>
                    <!-- Total Patients -->
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $totalPatients }}</h2>
                            <p class="text-light mb-0">Total Patients</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('assets/klinik/img/Putra-1.jpg') }}" alt="">
                        <div class="owl-carousel-text"></div>
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('assets/klinik/img/Rizky-1.jpg') }}" alt="">
                        <div class="owl-carousel-text"></div>
                    </div>
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('assets/klinik/img/Arifin-1.jpg') }}" alt="">
                        <div class="owl-carousel-text"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5 bg-light">
        <div class="container">
            <div class="row g-5">
                <!-- Gambar -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column">
                        <img class="img-fluid rounded w-75 align-self-end" src="{{ asset('assets/klinik/img/about-1.jpg') }}" alt="Tentang Kami 1">
                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="{{ asset('assets/klinik/img/about-2.jpg') }}" alt="Tentang Kami 2" style="margin-top: -25%;">
                    </div>
                </div>
                
                <!-- Teks -->
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="d-inline-block border rounded-pill py-1 px-4 text-secondary">Tentang Kami</p>
                    <h2 class="mb-4 text-primary">Klinik Dengan Pelayanan Kesehatan Yang Terjangkau</h2>
                    <p>Kami adalah klinik yang memberikan layanan kesehatan dasar dengan fokus pada kenyamanan dan keterjangkauan untuk masyarakat sekitar. Berpengalaman melayani pasien dari berbagai kalangan, kami percaya bahwa setiap orang berhak mendapatkan perawatan yang layak.</p>
                    <p class="mb-4">Dengan tenaga medis yang ramah dan fasilitas sederhana namun memadai, kami siap membantu Anda menjaga kesehatan sehari-hari tanpa perlu jauh-jauh ke rumah sakit besar.</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Pelayanan cepat dan ramah</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Dokter yang sudah berpengalaman</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Harga terjangkau untuk semua kalangan</p>
                    <a class="btn btn-outline-primary rounded-pill py-3 px-5 mt-3" href="{{ url('/appointment') }}">Appointment Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Service Start -->
    <div class="container-xxl py-5 bg-light">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4 text-secondary">Layanan Kami</p>
                <h1 class="text-primary">Layanan Klinik Sederhana</h1>
            </div>
            <div class="row g-4">
                <!-- Layanan Umum -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white rounded shadow-sm h-100 p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-stethoscope fs-4"></i>
                        </div>
                        <h5 class="mb-3">Pemeriksaan Umum</h5>
                        <p>Konsultasi dan pemeriksaan kesehatan dasar oleh dokter umum.</p>
                    </div>
                </div>

                <!-- Cek Laboratorium -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-white rounded shadow-sm h-100 p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-vial fs-4"></i>
                        </div>
                        <h5 class="mb-3">Cek Laboratorium</h5>
                        <p>Pemeriksaan darah, urin, dan laboratorium dasar lainnya.</p>
                    </div>
                </div>

                <!-- Rawat Luka Ringan -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service-item bg-white rounded shadow-sm h-100 p-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-4" style="width: 60px; height: 60px;">
                            <i class="fa fa-band-aid fs-4"></i>
                        </div>
                        <h5 class="mb-3">Perawatan Luka</h5>
                        <p>Penanganan luka ringan, perban, dan penggantian balutan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->



    <!-- Feature Start -->
    <div class="container-fluid bg-primary overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="p-lg-5 ps-lg-0">
                        <p class="d-inline-block border rounded-pill text-light py-1 px-4">Features</p>
                        <h1 class="text-white mb-4">Why Choose Us</h1>
                        <p class="text-white mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet</p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-user-md text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Experience</p>
                                        <h5 class="text-white mb-0">Doctors</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-check text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Quality</p>
                                        <h5 class="text-white mb-0">Services</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-comment-medical text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Positive</p>
                                        <h5 class="text-white mb-0">Consultation</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-headphones text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">24 Hours</p>
                                        <h5 class="text-white mb-0">Support</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('assets/klinik/img/feature.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

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

    <script>
    $(document).ready(function(){
    $('.header-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: true,
        navText: [
            '<span class="bi bi-arrow-left"></span>', 
            '<span class="bi bi-arrow-right"></span>'
            ]
        });
    });
    </script>

@endsection