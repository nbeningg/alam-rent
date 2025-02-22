<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <!-- basic -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- mobile metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1">
        <!-- site metas -->
        <title>AlamRent</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- bootstrap css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('template/css/bootstrap.min.css') }}">
        {{-- bootstrap icon --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- style css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('template/css/style.css') }}">
        <!-- Responsive-->
        <link rel="stylesheet" href="{{ asset('template/css/responsive.css') }}">
        <!-- fevicon -->
        <link rel="icon" href="{{ asset('template/images/fevicon.png') }}" type="image/gif" />
        <!-- font css -->
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="{{ asset('template/css/jquery.mCustomScrollbar.min.css') }}">
        <!-- Tweaks for older IEs-->
        <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">



    </head>
</head>

<body>
    <div class="header_section">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="{{ route('home') }}"><img
                        src="{{ asset('template/images/logoAL.png') }}"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('services') }}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('booking') }}">Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('client') }}">Review</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('bookings.index') }}" class="nav-link"><i
                                            class="bi bi-cart-check-fill"></i></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span>
                                            <i class="bi bi-caret-right-square-fill"></i>
                                            Welcome, {{ Auth::user()->name }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('/logout') }}">Sign out</a>
                                    </div>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="call_text_main">
        <div class="container">
            <div class="call_taital">
                <div class="call_text"><a href="https://maps.app.goo.gl/coV65iTGe5k89QrZ8"><i
                            class="fa fa-map-marker" aria-hidden="true"></i><span
                            class="padding_left_15">Location</span></a></div>
                <div class="call_text"><a href="https://web.whatsapp.com/"><i class="fa fa-phone"
                            aria-hidden="true"></i><span class="padding_left_15">(+62) 82122320125</span></a></div>
                <div class="call_text"><a href="https://mail.google.com/"><i class="fa fa-envelope"
                            aria-hidden="true"></i><span class="padding_left_15">alamrent@gmail.com</span></a></div>
            </div>
        </div>
    </div>


    <div class="content">
        @yield('content')
    </div>

    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="footeer_logo"><img src="{{ asset('template/images/logoAL.png') }}"></div>
                </div>
            </div>
            <div class="footer_section_2">
                <div class="row">
                    <div class="col">
                        <h4 class="footer_taital">
                            <a href="/register" class="footer_link">Register Now</a>
                        </h4>
                        <p class="footer_text">Berlangganan untuk mendapatkan penawaran eksklusif dan informasi terbaru
                            tentang paket kemah kami!</p>
                    </div>
                    <div class="col">
                        <h4 class="footer_taital">
                            <a href="/about" class="footer_link">Information</a>
                        </h4>
                        <p class="footer_text">Kami menyediakan pengalaman kemah yang tak terlupakan dengan fasilitas
                            lengkap</p>
                    </div>
                    <div class="col">
                        <h4 class="footer_taital">
                            <a href="/contact" class="footer_link">Helpful Links</a>
                        </h4>
                        <p class="footer_text">Kontak Kami - Hubungi Tim Kami untuk Informasi Lebih Lanjut</p>
                    </div>
                    <div class="col">
                        <h4 class="footer_taital">
                            <a href="/client" class="footer_link">Investments</a>
                        </h4>
                        <p class="footer_text">Testimoni Pelanggan - Pengalaman Mereka yang Telah Berkemah Bersama Kami
                        </p>
                    </div>
                    <div class="col">
                        <h4 class="footer_taital">Contact Us</h4>
                        <div class="location_text"><a href="https://maps.app.goo.gl/coV65iTGe5k89QrZ8"><i
                                    class="fa fa-map-marker" aria-hidden="true"></i><span
                                    class="padding_left_15">Location</span></a></div>
                        <div class="location_text"><a href="https://web.whatsapp.com/"><i class="fa fa-phone"
                                    aria-hidden="true"></i><span class="padding_left_15">(+62) 82122320125</span></a>
                        </div>
                        <div class="location_text"><a href="https://mail.google.com/"><i class="fa fa-envelope"
                                    aria-hidden="true"></i><span class="padding_left_15">alamrent@gmail.com</span></a>
                        </div>
                        <div class="social_icon">
                            <ul>
                                <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="https://x.com/"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li><a href="https://id.linkedin.com/"><i class="fa fa-linkedin"
                                            aria-hidden="true"></i></a>
                                </li>
                                <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="copyright_text">2023 All Rights Reserved. Design by <a href="https://html.design">Free
                            Html
                            Templates</a> Distributed By <a href="https://themewagon.com">ThemeWagon</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    {{-- Boostrap --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
