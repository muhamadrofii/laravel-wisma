<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    {{-- <a href="{{ url('/') }}" >test</a> --}}
    <a href="{{ url('/') }}">
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 40px;">
    {{-- test --}}
    </a>
    {{-- "C:\3.BUWONO\Dokumen\kuliah\SEMESTER 6\CODE MAGANG\sneat-livewire\sneat-bootstrap-laravel\public\assets\img\1logo.png" --}}
    {{-- <a href="{{ url('/') }}" class="app-brand-link"><x-app-logo />LIGAS GARIS KERAS</a> --}}
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
      <a class="menu-link" href="{{ route('dashboard') }}" wire:navigate>{{ __('Dashboard') }}</a>
    </li>
    {{-- <li class="menu-item {{ request()->is('pesertadiklat') ? 'active' : '' }}"> --}}
      {{-- <a class="menu-link" href="{{ route('pesertadiklat') }}" wire:navigate>{{ __('Peserta Diklat') }}</a> --}}
    {{-- </li> --}}
    <li class="menu-item {{ request()->is('masterusers') ? 'active' : '' }}">
      <a class="menu-link" href="{{ route('masterusers') }}" wire:navigate>{{ __('Kelola User') }}</a>
    </li>
    <li class="menu-item {{ request()->is('masterpenginapan') ? 'active' : '' }}">
      <a class="menu-link" href="{{ route('masterpenginapan') }}" wire:navigate>{{ __('Kelola Wisma') }}</a>
    </li>
        <li class="menu-item {{ request()->is('masterkamar') ? 'active' : '' }}">
      <a class="menu-link" href="{{ route('masterkamar') }}" wire:navigate>{{ __('Kelola Kamar') }}</a>
    </li>
            <li class="menu-item {{ request()->is('masterorder') ? 'active' : '' }}">
      <a class="menu-link" href="{{ route('masterorder') }}" wire:navigate>{{ __('Kelola Invoice') }}</a>
    </li>

    <!-- Settings -->
    <li class="menu-item {{ request()->is('settings/*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div class="text-truncate">{{ __('Settings') }}</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('settings.profile') ? 'active' : '' }}">
          <a class="menu-link" href="{{ route('settings.profile') }}" wire:navigate>{{ __('Profile') }}</a>
        </li>
        <li class="menu-item {{ request()->routeIs('settings.password') ? 'active' : '' }}">
          <a class="menu-link" href="{{ route('settings.password') }}" wire:navigate>{{ __('Password') }}</a>
        </li>
      </ul>
    </li>

    {{-- peserta diklat --}}

  </ul>
</aside>
<!-- / Menu -->

<script>
  // Toggle the 'open' class when the menu-toggle is clicked
  document.querySelectorAll('.menu-toggle').forEach(function(menuToggle) {
    menuToggle.addEventListener('click', function() {
      const menuItem = menuToggle.closest('.menu-item');
      // Toggle the 'open' class on the clicked menu-item
      menuItem.classList.toggle('open');
    });
  });
</script>
