<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard Toko</title>
    <style>
        :root{
            --green:#059669; /* primary */
            --accent:#047857; /* darker */
            --muted:#f0fdf4;
            --card-radius:12px;
            --text:#0f172a;
        }
        body{font-family:Inter,Segoe UI,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#f0fdf4,#f6fbf9);padding:28px;color:var(--text)}
        .container{max-width:1100px;margin:0 auto}
        .header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
        h1{font-size:20px;margin:0;color:var(--accent)}
        .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:18px}
        .card{background:#fff;border-radius:var(--card-radius);padding:18px;box-shadow:0 10px 30px rgba(4,120,87,0.05);}

        .stat-card{color:#fff;padding:14px;border-radius:12px;display:flex;justify-content:space-between;align-items:center;height:100px}
        .stat-card .meta{display:flex;flex-direction:column}
        .stat-card .label{font-size:13px;opacity:.95}
        .stat-card .value{font-size:20px;font-weight:700;margin-top:6px}
        .stat-card .icon{width:48px;height:48px;border-radius:999px;display:flex;align-items:center;justify-content:center;flex-shrink:0}

        .bg-yellow{background:linear-gradient(135deg,#f59e0b,#f97316)}
        .bg-green{background:linear-gradient(135deg,#10b981,#059669)}
        .bg-blue{background:linear-gradient(135deg,#60a5fa,#3b82f6)}
        .bg-purple{background:linear-gradient(135deg,#a78bfa,#7c3aed)}

        .profile-card{background:linear-gradient(90deg,var(--green),#34d399);color:#fff;padding:18px;border-radius:12px;display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
        .profile-card a{color:#fff;text-decoration:none;font-weight:600;display:inline-flex;align-items:center}
        .profile-card a .chev{width:36px;height:36px;border-radius:999px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center}

        .main-grid{display:grid;grid-template-columns:2fr 1fr;gap:18px}
        .chart{height:220px;background:#fff;border-radius:12px;padding:18px}
        .bars{display:flex;align-items:flex-end;height:140px;gap:12px}
        .bar{flex:1;border-radius:8px;background:linear-gradient(180deg,#34d399,#10b981);min-width:18px}

        .panel{background:#fff;border-radius:12px;padding:14px}
        .panel h3{margin:0 0 8px 0}
        .orders li,.products li{display:flex;justify-content:space-between;padding:10px 0;border-bottom:1px dashed #eef7f2}
        .orders li:last-child,.products li:last-child{border-bottom:0}

        @media(max-width:900px){.stats{grid-template-columns:repeat(2,1fr)} .main-grid{grid-template-columns:1fr}}
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Dashboard Toko</h1>
                <div style="color:#4b5563;font-size:13px">Selamat datang kembali! Kelola toko Anda dengan mudah</div>
            </div>
        </div>

        <div class="stats">
            <div class="stat-card bg-yellow">
                <div class="meta">
                    <div class="label">Rating Toko</div>
                    <div class="value">{{ $stats['rating'] ?? '—' }} / 5.0</div>
                    <div style="font-size:12px;opacity:.9;margin-top:6px">Berdasarkan {{ $stats['total_reviews'] ?? 0 }} ulasan</div>
                </div>
                <div class="icon" style="background:rgba(245,158,11,0.12);">
                    <!-- star icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" fill="#f59e0b"/>
                    </svg>
                </div>
            </div>

            <div class="stat-card bg-green">
                <div class="meta">
                    <div class="label">Total Penjualan</div>
                    <div class="value">{{ number_format($stats['total_sales'] ?? 0) }}</div>
                    <div style="font-size:12px;opacity:.9;margin-top:6px">Transaksi berhasil</div>
                </div>
                <div class="icon" style="background:rgba(16,185,129,0.12);">
                    <!-- cart icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 4h-2l-1 2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h9v-2h-8.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h5.72c.75 0 1.41-.41 1.75-1.03l3.58-6.49-1.74-1-3.58 6.49h-7.1" fill="#059669"/>
                    </svg>
                </div>
            </div>

            <div class="stat-card bg-blue">
                <div class="meta">
                    <div class="label">Total Produk</div>
                    <div class="value">{{ $stats['total_products'] ?? 0 }}</div>
                    <div style="font-size:12px;opacity:.9;margin-top:6px">Produk aktif</div>
                </div>
                <div class="icon" style="background:rgba(59,130,246,0.12);">
                    <!-- box icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73L12 2 4 6.27A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73L12 22l8-4.27A2 2 0 0 0 21 16z" fill="#3b82f6"/>
                    </svg>
                </div>
            </div>

            <div class="stat-card bg-purple">
                <div class="meta">
                    <div class="label">Total Ulasan</div>
                    <div class="value">{{ $stats['total_reviews'] ?? 0 }}</div>
                    <div style="font-size:12px;opacity:.9;margin-top:6px">Ulasan pelanggan</div>
                </div>
                <div class="icon" style="background:rgba(167,139,250,0.12);">
                    <!-- chat icon -->
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 15a2 2 0 0 1-2 2H8l-5 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" fill="#7c3aed"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="profile-card">
            <div>
                <div style="font-weight:700">Kelola Profil Toko</div>
                <div style="opacity:.95;margin-top:6px">Atur informasi toko, kontak, operasional, branding, dan sosial media</div>
            </div>
            <div>
                <a href="{{ route('seller.profile') }}">
                    <span class="chev" aria-hidden="true">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 6l6 6-6 6" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>

        <div class="main-grid">
            <div>
                <div class="chart card">
                    <h3 style="margin-top:0">Grafik Penjualan</h3>
                    <div style="color:#6b7280;font-size:12px;margin-bottom:10px">6 bulan terakhir</div>
                    <div class="bars">
                        <div class="bar" style="height:48%"></div>
                        <div class="bar" style="height:62%"></div>
                        <div class="bar" style="height:54%"></div>
                        <div class="bar" style="height:78%"></div>
                        <div class="bar" style="height:66%"></div>
                        <div class="bar" style="height:86%"></div>
                    </div>
                </div>

                <div style="display:flex;gap:18px;margin-top:18px">
                    <div class="panel card" style="flex:1">
                        <h3>Pesanan Terbaru</h3>
                        <ul class="orders" style="list-style:none;padding:0;margin:0">
                            <li><div>#ORD-001<br><small style="color:#6b7280">Ahmad Hidayat</small></div><div>Rp 15.000.000<br><small style="color:#f59e0b">Pending</small></div></li>
                            <li><div>#ORD-002<br><small style="color:#6b7280">Siti Nurhaliza</small></div><div>Rp 250.000<br><small style="color:#f97316">Processing</small></div></li>
                            <li><div>#ORD-003<br><small style="color:#6b7280">Budi Santoso</small></div><div>Rp 1.200.000<br><small style="color:#06b6d4">Shipped</small></div></li>
                            <li><div>#ORD-004<br><small style="color:#6b7280">Dewi Lestari</small></div><div>Rp 2.500.000<br><small style="color:#10b981">Delivered</small></div></li>
                        </ul>
                    </div>

                    <div class="panel card" style="width:320px">
                        <h3>Produk Terlaris</h3>
                        <ul class="products" style="list-style:none;padding:0;margin:0">
                            <li><div>Laptop Gaming ASUS<br><small style="color:#6b7280">#1 · 45 terjual</small></div><div style="font-weight:700">Rp 67.5M</div></li>
                            <li><div>Mouse Logitech G502<br><small style="color:#6b7280">#2 · 125 terjual</small></div><div style="font-weight:700">Rp 30.7M</div></li>
                            <li><div>Keyboard Corsair K70<br><small style="color:#6b7280">#3 · 89 terjual</small></div><div style="font-weight:700">Rp 106.8M</div></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <div class="panel card">
                    <h3>Ringkasan Profil</h3>
                    @if($seller)
                        <p style="margin:8px 0"><strong>{{ $seller->store_name }}</strong></p>
                        <p style="color:#6b7280;margin:6px 0">{{ $seller->store_description }}</p>
                        <p style="margin:6px 0"><strong>Pemilik:</strong> {{ $seller->owner_name }}</p>
                        <p style="margin:6px 0"><strong>Email:</strong> {{ $seller->email }}</p>
                    @else
                        <p>Tidak ada profil toko terdaftar.</p>
                    @endif
                </div>

                <div class="panel card" style="margin-top:18px">
                    <h3>Statistik Cepat</h3>
                    <div style="display:flex;gap:8px;flex-wrap:wrap">
                        <div style="background:#f0fff6;padding:10px;border-radius:8px;flex:1">Total Penjualan<br><strong>{{ number_format($stats['total_sales'] ?? 0) }}</strong></div>
                        <div style="background:#f0f9ff;padding:10px;border-radius:8px;flex:1">Produk Aktif<br><strong>{{ $stats['total_products'] ?? 0 }}</strong></div>
                        <div style="background:#fff7ed;padding:10px;border-radius:8px;flex:1">Ulasan<br><strong>{{ $stats['total_reviews'] ?? 0 }}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>