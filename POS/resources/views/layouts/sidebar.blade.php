<div class="sidebar" style="background-color: #0f172a; min-height: 100vh; color: #ffffff; font-family: 'Segoe UI', sans-serif;">
    <!-- User Panel -->
    <div class="user-panel d-flex align-items-center p-3 border-bottom" style="border-color: #334155;">
        <div class="image me-2">
            <img src="{{ auth()->user()->foto ? asset('storage/uploads/user/' . auth()->user()->foto) : asset('images/default.png') }}"
                 alt="User Image"
                 style="width: 45px; height: 45px; object-fit: cover; border-radius: 50%; border: 2px solid #3b82f6;">
        </div>
        <div class="info">
            <a href="{{ route('profile.edit') }}" class="d-block fw-semibold text-white" style="text-decoration: none;">
                {{ auth()->user()->nama }}
            </a>
        </div>
    </div>

    <!-- Search Box -->
    <div class="p-3">
        <div class="input-group">
            <input class="form-control text-white border-0" type="search" placeholder="Cari..." aria-label="Search" style="background-color: #1e293b;">
            <button class="btn btn-primary" style="background-color: #3b82f6; border: none;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <!-- Menu -->
    <nav>
        <ul class="nav nav-pills flex-column px-2">
            <li class="nav-item mb-1">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }} {{ ($activeMenu == 'dashboard') ? 'bg-primary text-white' : 'text-white' }}"
                   style="border-radius: 10px;">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-header text-muted px-2 mt-3 fw-bold text-uppercase small" style="letter-spacing: 0.5px;">Data Pengguna</li>
            <li class="nav-item mb-1">
                <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="fas fa-layer-group me-2"></i> Level User
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="far fa-user me-2"></i> Data User
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('profile.edit') }}" class="nav-link {{ ($activeMenu == 'profile') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                   <i class="fas fa-user-astronaut me-2"></i> Profil Saya
                </a>
            </li>

            <li class="nav-header text-muted px-2 mt-3 fw-bold text-uppercase small">Data Barang</li>
            <li class="nav-item mb-1">
                <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="far fa-bookmark me-2"></i> Kategori Barang
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ url('/supplier') }}" class="nav-link {{ ($activeMenu == 'supplier') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="fas fa-box-open me-2"></i> Data Supplier
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="far fa-list-alt me-2"></i> Data Barang
                </a>
            </li>

            <li class="nav-header text-muted px-2 mt-3 fw-bold text-uppercase small">Data Transaksi</li>
            <li class="nav-item mb-1">
                <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="fas fa-cubes me-2"></i> Stok Barang
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ url('/transaksi') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'bg-primary text-white' : 'text-white' }}" style="border-radius: 10px;">
                    <i class="fas fa-cash-register me-2"></i> Transaksi Penjualan
                </a>
            </li>

            <li class="nav-item mt-4">
                <form id="logout-form-sidebar" action="{{ url('logout') }}" method="GET">
                    @csrf
                    <button type="submit" class="nav-link btn text-white w-100" style="background-color: #ef4444; border-radius: 10px;">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</div>
