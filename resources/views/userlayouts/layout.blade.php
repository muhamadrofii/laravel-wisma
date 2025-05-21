<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>{{ $title ?? 'Wisma Migas' }}</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />


@props([
    'pageTitle',
])


<title>@yield('title') |
  {{ config('variables.templateName') ? config('variables.templateName') : 'TemplateName' }} -
  {{ config('variables.templateSuffix') ? config('variables.templateSuffix') : 'TemplateSuffix' }}
</title>

<meta name="description" content="{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
<meta name="keywords" content="{{ config('variables.templateKeyword') ? config('variables.templateKeyword') : '' }}">
<!-- laravel CRUD token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Canonical SEO -->
<meta property="og:title" content="{{ config('variables.templateName') ? config('variables.templateName') : '' }}{{ config('variables.ogTitle') ? config('variables.ogTitle') : '' }}" />
<meta property="og:type" content="{{ config('variables.ogType') ? config('variables.ogType') : '' }}" />
<meta property="og:url" content="{{ config('variables.productPage') ? config('variables.productPage') : '' }}" />
<meta property="og:image" content="{{ config('variables.ogImage') ? config('variables.ogImage') : '' }}" />
<meta property="og:description" content="{{ config('variables.templateName') ? config('variables.templateName') : '' }}{{ config('variables.templateDescription') ? config('variables.templateDescription') : '' }}" />
<meta property="og:site_name" content="{{ config('variables.creatorName') ? config('variables.creatorName') : '' }}" />
<link rel="canonical" href="{{ config('variables.productPage') ? config('variables.productPage') : '' }}">
<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />


<!-- Include Styles -->
@include('partials.styles')

@livewireStyles

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&family=Poppins&family=Raleway&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  @livewireStyles
</head>

<body class="index-page">
  {{-- Header --}}
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/1logo.png') }}" alt="Logo" style="max-height: 90px; height: auto; width: auto;">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          {{-- <li><a href="#hero" class="active">Homes</a></li> --}}
          <li><a href="{{ route('user.home') }}">Pesan Kamar</a></li>
          <li><a href="{{ route('livewire.user.history-user') }}">Riwayat</a></li>
          {{-- <li><a href="#about">About</a></li> --}}
          {{-- <li><a href="#portfolio">Info</a></li> --}}
          {{-- <li><a href="#team">Team</a></li> --}}
          {{-- <li><a href="#contact">Contact</a></li> --}}
          <li><a href="{{ route('livewire.user.profile-user') }}">Profile</a></li>

          {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden"> --}}
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
            </a>
          
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
              @csrf
            </form>
          </li>
          
          {{-- <li><a href="{{ route('login') }}" class="btn-get-started">Get Started</a></li> --}}
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  {{-- Content --}}
  <main>
    {{ $slot }}
  </main>

  <footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <span class="sitename">Wisma Migas</span>
          </a>
          <div class="footer-contact pt-3">
            <p>PPSDM MIGAS</p>
            <p>Cepu, Blora 58315</p>
            <p class="mt-3"><strong>Phone:</strong> <span>0296421888</span></p>
            <p><strong>Email:</strong> <span>SOLIKIN MOBILE@Gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
  
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Link Terkait</h4>
          <ul>
            <li><a href="https://migas.esdm.go.id/">Kementrian ESDM</a></li>
            <li><a href="https://migas.esdm.go.id/search?query=ditjen+migas">Ditjen Migas</a></li>
            <li><a href="https://www.skkmigas.go.id/">SKK Migas</a></li>
            <li><a href="https://www.bphmigas.go.id/">BPH Migas</a></li>
            <li><a href="https://diklat.ppsdmkebtke.esdm.go.id/beranda">PPSDM KEBTKE</a></li>
            <li><a href="https://ppsdmgeominerba.id/">PPSDM Geominerba</a></li>
            <li><a href="https://bpsdm.esdm.go.id/">PPSDM Aparatur</a></li>
            <li><a href="https://akamigas.ac.id/">PEM AKAMIGAS</a></li>
          </ul>
        </div>
  
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Pelayanan Publik</h4>
          <ul>
            <li><a href="https://wbs.esdm.go.id/">Wistle Bowling System</a></li>
            <li><a href="https://www.lapor.go.id/index.php/">Lapor</a></li>
            <li><a href="https://eproc.esdm.go.id/">LPSE Kementrian ESDM</a></li>
            <li><a href="https://gol.kpk.go.id/login">Gratifikasi Online</a></li>
            <li><a href="https://blu.djpbn.kemenkeu.go.id/">BLU Promise</a></li>
            <li><a href="https://ppsdmmigas.esdm.go.id/limesurvey/index.php/564383?lang=id">Survey Persepsi Korupsi</a></li>
          </ul>
        </div>
  
        <div class="col-lg-4 col-md-12 footer-newsletter">
          <h4>Lokasi</h4>
          <p>Jl. Sorogo No.1, Kampungbaru, Karangboyo, Kec. Cepu, Kabupaten Blora, Jawa Tengah 58315</p>
          <form action="#" method="post" class="php-email-form">
            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
          </form>
        </div>
      </div>
    </div>
  
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">TEAM IT PKL UNUGIRI</strong> <span>All Rights Reserved</span></p>
      <div class="credits">Designed by <a href="#">TEAM ITT UNUGIRI</a></div>
    </div>
  </footer>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
  {{-- <x-layouts.navbar.default /> --}}

  {{-- Footer --}}
  {{-- @include('layouts.footer') --}}

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  {{-- <div id="preloader"></div> --}}

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>



  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- BEGIN: Vendor JS-->

@vite([
  'resources/assets/vendor/libs/jquery/jquery.js',
  'resources/assets/vendor/libs/popper/popper.js',
  'resources/assets/vendor/js/bootstrap.js',
])

<!-- Page Vendor JS-->
@yield('vendor-script')
<!-- END: Page Vendor JS-->

@vite(['resources/js/app.js'])

<!-- BEGIN: Page JS-->
@yield('page-script')
<!-- END: Page JS-->

<!-- Place this tag before closing body tag for github widget button. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

  @livewireScripts
  @stack('scripts')
</body>

</html>
