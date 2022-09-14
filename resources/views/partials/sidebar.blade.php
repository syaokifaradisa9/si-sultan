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
        <li class="{{ Request::is('home_admin_divisi') ? 'active' : '' }}"><a class="nav-link" href="/home_admin_divisi"><i class="fas fa-th-large">
            </i> Home</a>
        </li>
      @endisAdminDiv

      @isKadiv
        <li class="menu-header">Kepala Divisi</li>
        <li class="{{ Request::is('home_kepala_divisi') ? 'active' : '' }}"><a class="nav-link" href="/home_kepala_divisi"><i class="fas fa-th-large">
            </i> Home</a>
        </li>
      @endisKadiv

      @isTo
        <li class="menu-header">Tata Operasional</li>
        <li class="{{ Request::is('home_tata_operasional') ? 'active' : '' }}"><a class="nav-link" href="/home_tata_operasional"><i
              class="fas fa-th-large">
            </i> Home</a>
        </li>
      @endisTo

      @isAdum
        <li class="menu-header">Administrasi Umum</li>
        <li class="{{ Request::is('home_administrasi_umum') ? 'active' : '' }}"><a class="nav-link" href="/home_administrasi_umum"><i
              class="fas fa-th-large">
            </i> Home</a>
        </li>
      @endisAdum

      @isLead
        <li class="menu-header">Kepala LPFK</li>
        <li class="{{ Request::is('home_kepala_lpfk') ? 'active' : '' }}"><a class="nav-link" href="/home_kepala_lpfk"><i class="fas fa-th-large">
            </i> Home</a>
        </li>
      @endisLead

      @isPpk
        <li class="menu-header">PPK</li>
        <li class="{{ Request::is('home_ppk') ? 'active' : '' }}"><a class="nav-link" href="/home_ppk"><i class="fas fa-th-large">
            </i> Home</a>
        </li>
      @endisPpk

      @isSuperadmin
        <li class="menu-header">Superadmin</li>
        <li class="{{ Request::is('home_superadmin') ? 'active' : '' }}"><a class="nav-link" href="/home_superadmin"><i class="fas fa-th-large">
            </i> Home</a>
        </li>
        <li class="{{ Request::is('register') ? 'active' : '' }}"><a class="nav-link" href="/register"><i class="fas fa-user-plus">
            </i> Add New Users</a>
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
