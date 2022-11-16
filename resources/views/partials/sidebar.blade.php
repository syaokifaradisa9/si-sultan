<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand text-center">
      <img src="{{ asset('assets/img//logo/logo-crop.png') }}" alt="logo" width="60">
      <h6>SI-SULTAN</h6>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="http://si-sultan.test/">BPFK</a>
    </div>
    <ul class="sidebar-menu mt-3">
      @isAdminDiv
        <li class="menu-header">Admin Divisi</li>
        <li class="nav-item {{ Request::is('addiv/home') ? 'active' : '' }}">
          <a href="/addiv/home" class="nav-link">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('addiv/order*') ? 'active' : '' }}">
          <a href="/addiv/order" class="nav-link ">
            <i class="fas fa-list-ul"></i><span>Usulan</span>
          </a>
        </li>
        <hr style="margin: 15px 20px">
        <li class="menu-header">Inventaris</li>
        <li class="nav-item {{ Request::is('addiv/inventory*') ? 'active' : '' }}">
          <a href="/addiv/inventory" class="nav-link ">
            <i class="fas fa-archive"></i><span>Kelola Inventaris</span>
          </a>
        </li>
      @endisAdminDiv

      @isKadiv
        <li class="menu-header">Kepala Divisi</li>
        </li>
        <li class="nav-item {{ Request::is('kadiv/home') ? 'active' : '' }}">
          <a href="/kadiv/home" class="nav-link ">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('kadiv/order*') ? 'active' : '' }}">
          <a href="/kadiv/order" class="nav-link ">
            <i class="fas fa-list-ul"></i><span>Usulan</span>
          </a>
        </li>
      @endisKadiv

      @isMutu
        <li class="menu-header">Mutu Operasional</li>
        </li>
        <li class="nav-item {{ Request::is('mutu/home') ? 'active' : '' }}">
          <a href="/mutu/home" class="nav-link ">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('mutu/order*') ? 'active' : '' }}">
          <a href="/mutu/order" class="nav-link ">
            <i class="fas fa-list-ul"></i><span>Usulan</span>
          </a>
        </li>
        <hr style="margin: 15px 20px">
        <li class="menu-header">Usulan</li>
        <li class="nav-item {{ Request::is('mutu/approved*') ? 'active' : '' }}">
          <a href="/mutu/approved" class="nav-link ">
            <i class="fas fa-check-circle"></i><span>Disetujui</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('mutu/pending*') ? 'active' : '' }}">
          <a href="/mutu/pending" class="nav-link ">
            <i class="fas fa-exclamation-circle"></i><span>Ditunda</span>
          </a>
        </li>
      @endisMutu

      @isAdum
        <li class="menu-header">Administrasi Umum</li>
        </li>
        <li class="nav-item {{ Request::is('adum/home') ? 'active' : '' }}">
          <a href="/adum/home" class="nav-link ">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('adum/order*') ? 'active' : '' }}">
          <a href="/adum/order" class="nav-link ">
            <i class="fas fa-list-ul"></i><span>Usulan</span>
          </a>
        </li>
      @endisAdum

      @isLead
        <li class="menu-header">Kepala LPFK</li>
        </li>
        <li class="nav-item {{ Request::is('lpfk/home') ? 'active' : '' }}">
          <a href="/lpfk/home" class="nav-link ">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('lpfk/order*') ? 'active' : '' }}">
          <a href="/lpfk/order" class="nav-link ">
            <i class="fas fa-list-ul"></i><span>Usulan</span>
          </a>
        </li>
      @endisLead

      @isPpk
        <li class="menu-header">PPK</li>
        <li class="nav-item {{ Request::is('ppk/home') ? 'active' : '' }}">
          <a href="/ppk/home" class="nav-link ">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('ppk/order*') ? 'active' : '' }}">
          <a href="/ppk/order" class="nav-link ">
            <i class="fas fa-list-ul"></i><span>Usulan</span>
          </a>
        </li>
        <hr style="margin: 15px 20px">
        <li class="menu-header">Usulan</li>
        <li class="nav-item {{ Request::is('ppk/received*') ? 'active' : '' }}">
          <a href="/ppk/received" class="nav-link ">
            <i class="fas fa-check-circle"></i><span>Diterima</span>
          </a>
        </li>
      @endisPpk

      @isSuperadmin
        <li class="menu-header">Superadmin</li>
        <li class="nav-item {{ Request::is('admin/home') ? 'active' : '' }}">
          <a href="/admin/home" class="nav-link ">
            <i class="fas fa-home"></i><span>Beranda</span>
          </a>
        </li>
      @endisSuperadmin
    </ul>
  </aside>
</div>
