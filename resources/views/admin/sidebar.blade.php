<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="d-flex justify-content-center w-100">
        <a href="{{ '/' }}"class="brand-link">
            {{-- <img src="{{ asset('/lte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image img-circle elevation-3"> --}}
            <i class="fa-brands fa-edge-legacy"></i>
            <span class="brand-text font-weight-light">-POLI</span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('adminindex') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('showlistpasien') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            List Pasien
                            <i class="right fa-solid fa-arrow-right"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('showlistdokter') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-user-tie"></i>
                        <p>
                            List Dokter
                            <i class="right fa-solid fa-arrow-right"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('showlistpoli') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-building"></i>
                        <p>
                            List Poli
                            <i class="right fa-solid fa-arrow-right"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('showlistobat') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-bag-shopping"></i>
                        <p>
                            List Obat
                            <i class="right fa-solid fa-arrow-right"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
