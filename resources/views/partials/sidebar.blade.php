<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="">SI-SULTAN</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      @isAdminDiv
        <li class="menu-header">Admin Divisi</li>
        <li class="nav-item {{ Request::is('addiv/home') ? 'active' : '' }}">
          <a href="/addiv/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
      @endisAdminDiv

      @isKadiv
        <li class="menu-header">Kepala Divisi</li>
        <li class="nav-item {{ Request::is('kadiv/home') ? 'active' : '' }}">
          <a href="/kadiv/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
      @endisKadiv

      @isTo
        <li class="menu-header">Tata Operasional</li>
        <li class="nav-item {{ Request::is('to/home') ? 'active' : '' }}">
          <a href="/to/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
      @endisTo

      @isAdum
        <li class="menu-header">Administrasi Umum</li>
        <li class="nav-item {{ Request::is('adum/home') ? 'active' : '' }}">
          <a href="/adum/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
      @endisAdum

      @isLead
        <li class="menu-header">Kepala LPFK</li>
        <li class="nav-item {{ Request::is('lpfk/home') ? 'active' : '' }}">
          <a href="/lpfk/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
      @endisLead

      @isPpk
        <li class="menu-header">PPK</li>
        <li class="nav-item {{ Request::is('ppk/home') ? 'active' : '' }}">
          <a href="/ppk/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
      @endisPpk

      @isSuperadmin
        <li class="menu-header">Superadmin</li>
        <li class="nav-item {{ Request::is('admin/home') ? 'active' : '' }}">
          <a href="/admin/home" class="nav-link ">
            <i class="fas fa-th-large"></i><span>Home</span>
          </a>
        </li>
        <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
          <a href="/register" class="nav-link ">
            <i class="fas fa-user-plus"></i><span>Add New User</span>
          </a>
        </li>
      @endisSuperadmin
    </ul>

    {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
          <i class="fas fa-rocket"></i> Documentation
        </a>
      </div> --}}
  </aside>
</div>
