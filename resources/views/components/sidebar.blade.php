<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="{{ route('dashboard') }}" class="sidebar-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="light-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="dark-logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('laporan.pembelian') }}">
                <iconify-icon icon="mdi:file-report-outline" class="menu-icon"></iconify-icon>
                    <span>Riwayat Pembelian</span>
                </a>
            </li>
                        <li>
                <a href="{{ route('laporan.topup') }}">
                <iconify-icon icon="tabler:report-money" class="menu-icon"></iconify-icon>
                    <span>Riwayat Top Up</span>
                </a>
            </li>
            
        </ul>
    </div>
</aside>
