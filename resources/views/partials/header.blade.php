<div class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('template/images/logoAL.png') }}"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="{{ route('client') }}">Client</a>
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
            <div class="call_text"><a href="https://maps.app.goo.gl/coV65iTGe5k89QrZ8"><i class="fa fa-map-marker"
                        aria-hidden="true"></i><span class="padding_left_15">Location</span></a></div>
            <div class="call_text"><a href="https://web.whatsapp.com/"><i class="fa fa-phone"
                        aria-hidden="true"></i><span class="padding_left_15">(+62) 82122320125</span></a></div>
            <div class="call_text"><a href="https://mail.google.com/"><i class="fa fa-envelope"
                        aria-hidden="true"></i><span class="padding_left_15">alamrent@gmail.com</span></a></div>
        </div>
    </div>
</div>
