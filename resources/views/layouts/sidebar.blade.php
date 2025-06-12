<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href="{{ asset('/') }}backend/html/ltr/vertical-menu-template/index.html"><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                    y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                    y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                            style="fill:currentColor"></path>
                                        <path id="Path1"
                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                            fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                        </polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    {{-- {{ url($setting->gambar_logo) }} --}}
                    <h2 class="brand-text">{{ $setting->nama_perusahaan }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Email">Dashboard</span></a>
            </li>
            @if (Auth::user()->role_id == 1)
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">INVENTORY</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/kategori') }}"><i
                            data-feather="align-justify"></i><span class="menu-title text-truncate"
                            data-i18n="Chat">Kategori</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('produk') }}"><i
                            data-feather="shopping-bag"></i><span class="menu-title text-truncate"
                            data-i18n="Email">Produk</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/supplier') }}"><i
                            data-feather="truck"></i><span class="menu-title text-truncate"
                            data-i18n="Calendar">Supplier</span></a>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/member') }}"><i
                            data-feather="credit-card"></i><span class="menu-title text-truncate"
                            data-i18n="Todo">Member</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">Transaksi</span><i
                        data-feather="more-horizontal"></i>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center"
                        href="{{ route('detail_transaksi.index') }}"><i data-feather="shopping-cart"></i><span
                            class="menu-title text-truncate" data-i18n="Typography">Transaksi Aktif</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center"
                        href="{{ route('detail_transaksi.baru') }}"><i data-feather="shopping-cart"></i><span
                            class="menu-title text-truncate" data-i18n="Typography">Transaksi Baru</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/pembelian') }}"><i
                            data-feather="arrow-down-circle"></i><span class="menu-title text-truncate"
                            data-i18n="Colors">Pembelian</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/penjualan') }}"><i
                            data-feather="arrow-up-circle"></i><span class="menu-title text-truncate"
                            data-i18n="Colors">Penjualan</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/pengeluaran') }}"><i
                            data-feather="minus-circle"></i><span class="menu-title text-truncate"
                            data-i18n="Colors">Pengeluaran</span></a>
                </li>

                <li class=" navigation-header"><span data-i18n="Forms &amp; Tables">Laporan</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/laporan') }}"><i
                            data-feather="file"></i><span class="menu-title text-truncate"
                            data-i18n="ag-grid">Laporan</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Charts &amp; Maps">User &amp; Settings</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/users') }}"><i
                            data-feather="user"></i><span class="menu-title text-truncate"
                            data-i18n="Leaflet Maps">User</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/setting') }}"><i
                            data-feather="settings"></i><span class="menu-title text-truncate"
                            data-i18n="Leaflet Maps">Settings</span></a>
                </li>
            @else
                <li class=" navigation-header"><span data-i18n="User Interface">INVENTORY</span><i
                        data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="{{ url('/member') }}"><i
                            data-feather="credit-card"></i><span class="menu-title text-truncate"
                            data-i18n="Todo">Member</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">Transaksi</span><i
                        data-feather="more-horizontal"></i>
                </li>

                <li class=" nav-item"><a class="d-flex align-items-center"
                        href="{{ route('detail_transaksi.index') }}"><i data-feather="shopping-cart"></i><span
                            class="menu-title text-truncate" data-i18n="Typography">Transaksi Aktif</span></a>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center"
                        href="{{ route('detail_transaksi.baru') }}"><i data-feather="shopping-cart"></i><span
                            class="menu-title text-truncate" data-i18n="Typography">Transaksi Baru</span></a>
                </li>
            @endif
        </ul>
    </div>
</div>
