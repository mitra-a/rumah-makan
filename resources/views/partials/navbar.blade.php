<header class="navbar navbar-expand-md navbar-light d-print-none">
    <div class="container">
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/" class="href">
              <img 
                src="https://preview.tabler.io//static/logo.svg" 
                width="110" 
                height="32" 
                alt="Tabler" 
                class="navbar-brand-image" 
              />
            </a>
        </h1>

        <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
                    <a href="/" class="nav-link">Home</a>
                </li>

                <li class="nav-item {{ Route::is('data.menu') ? 'active' : '' }}">
                    <a href="{{ route('data.menu') }}" class="nav-link">Menu</a>
                </li>

                <li class="nav-item {{ Route::is('data.meja') ? 'active' : '' }}">
                    <a href="{{ route('data.meja') }}" class="nav-link">Meja</a>
                </li>

                <li class="nav-item {{ Route::is('data.transaksi') ? 'active' : '' }}">
                    <a href="{{ route('data.transaksi') }}" class="nav-link">Transaksi</a>
                </li>
            </ul>
        </div>
    </div>
</header>