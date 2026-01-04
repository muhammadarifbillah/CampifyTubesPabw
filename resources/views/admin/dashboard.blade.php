<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green:#10b981;--accent:#0f766e;--blue:#2563eb;--muted:#f3faf6}
        body{font-family:Inter,Segoe UI,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#f0fdf4,#fbfffb);padding:28px;color:#0b1220}
        .container{max-width:1100px;margin:0 auto}
        h1{color:var(--accent);margin:0 0 6px 0}
        .subtitle{color:#065f46;font-size:13px;margin-bottom:18px}
        .stats{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-bottom:20px}
        .stat{background:#fff;border-radius:12px;padding:18px;box-shadow:0 8px 22px rgba(16,185,129,0.06);display:flex;align-items:center;gap:12px}
        .stat .badge{width:48px;height:48px;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff}
        .stat .meta{flex:1}
        .stat .value{font-size:18px;font-weight:700}
        .stat .label{font-size:13px;color:#6b7280}
        .badge.green{background:linear-gradient(135deg,#10b981,#059669)}
        .badge.blue{background:linear-gradient(135deg,#60a5fa,#3b82f6)}
        .badge.purple{background:linear-gradient(135deg,#a78bfa,#7c3aed)}
        .badge.orange{background:linear-gradient(135deg,#f59e0b,#f97316)}

        .big-cards{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:18px}
        .big{border-radius:12px;padding:22px;color:#fff;display:flex;align-items:center;justify-content:space-between}
        .big.green{background:linear-gradient(90deg,#10b981,#059669)}
        .big.blue{background:linear-gradient(90deg,#2563eb,#3b82f6)}
        .big .left{display:flex;align-items:center;gap:12px}
        .big .title{font-weight:700}
        .chev{width:44px;height:44px;border-radius:999px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center}

        .panels{display:grid;grid-template-columns:1fr 1fr;gap:18px}
        .panel{background:#fff;border-radius:12px;padding:16px;box-shadow:0 8px 20px rgba(4,120,87,0.03)}
        .list-item{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px dashed #eef7f2}
        .list-item:last-child{border-bottom:0}
        .avatar{width:40px;height:40px;border-radius:999px;background:var(--muted);display:flex;align-items:center;justify-content:center;color:var(--green);font-weight:700}
        .meta small{display:block;color:#6b7280}

        @media(max-width:900px){.stats{grid-template-columns:repeat(2,1fr)} .big-cards{grid-template-columns:1fr} .panels{grid-template-columns:1fr}}
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <div class="subtitle">Kelola data pembeli dan penjual marketplace</div>

        <div class="stats">
            <div class="stat">
                <div class="badge green"><i class="fas fa-users"></i></div>
                <div class="meta"><div class="value">{{ $totals['buyers'] ?? 0 }}</div><div class="label">Total Pembeli</div></div>
                <div style="color:#10b981;font-size:13px">+12.5%</div>
            </div>

            <div class="stat">
                <div class="badge blue"><i class="fas fa-store"></i></div>
                <div class="meta"><div class="value">{{ $totals['sellers'] ?? 0 }}</div><div class="label">Total Penjual</div></div>
                <div style="color:#059669;font-size:13px">+8.2%</div>
            </div>

            <div class="stat">
                <div class="badge purple"><i class="fas fa-shopping-cart"></i></div>
                <div class="meta"><div class="value">{{ number_format($totals['transactions'] ?? 0) }}</div><div class="label">Transaksi Bulan Ini</div></div>
                <div style="color:#059669;font-size:13px">+23.1%</div>
            </div>

            <div class="stat">
                <div class="badge orange"><i class="fas fa-chart-line"></i></div>
                <div class="meta"><div class="value">{{ $totals['revenue_label'] ?? 'Rp 0' }}</div><div class="label">Total Revenue</div></div>
                <div style="color:#059669;font-size:13px">+15.3%</div>
            </div>
        </div>

        <div class="big-cards">
            <a href="{{ route('admin.buyers.index') }}" style="text-decoration:none">
                <div class="big green">
                    <div class="left"><div style="width:48px;height:48px;border-radius:10px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center"><i class="fas fa-user" style="font-size:20px;color:#fff"></i></div><div><div style="font-weight:700">Kelola Data Pembeli</div><div style="opacity:.95">Lihat dan kelola semua data pembeli</div></div></div>
                    <div class="chev"><i class="fas fa-arrow-right" style="color:#fff"></i></div>
                </div>
            </a>

            <a href="{{ route('admin.sellers.index') }}" style="text-decoration:none">
                <div class="big blue">
                    <div class="left"><div style="width:48px;height:48px;border-radius:10px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center"><i class="fas fa-store" style="font-size:20px;color:#fff"></i></div><div><div style="font-weight:700">Kelola Data Penjual</div><div style="opacity:.95">Lihat dan kelola semua data penjual</div></div></div>
                    <div class="chev"><i class="fas fa-arrow-right" style="color:#fff"></i></div>
                </div>
            </a>
        </div>

        <div class="panels">
            <div class="panel">
                <h3>Pembeli Terbaru <a href="{{ route('admin.buyers.index') }}" style="float:right;color:var(--green);text-decoration:none">Lihat Semua →</a></h3>
                <div style="margin-top:12px">
                    @foreach($recentBuyers as $b)
                        <div class="list-item">
                            <div class="avatar">{{ strtoupper(substr($b->name,0,1)) }}</div>
                            <div class="meta"><strong>{{ $b->name }}</strong><small>{{ $b->email }}</small></div>
                            <div style="margin-left:auto;color:#10b981;font-size:12px">{{ $b->created_at->format('j M Y') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="panel">
                <h3>Penjual Terbaru <a href="{{ route('admin.sellers.index') }}" style="float:right;color:var(--blue);text-decoration:none">Lihat Semua →</a></h3>
                <div style="margin-top:12px">
                    @foreach($recentSellers as $s)
                        <div class="list-item">
                            <div class="avatar">{{ strtoupper(substr($s->store_name,0,1)) }}</div>
                            <div class="meta"><strong>{{ $s->store_name }}</strong><small>{{ $s->owner_name }}</small></div>
                            <div style="margin-left:auto;color:#6b7280;font-size:12px">{{ $s->created_at->format('j M Y') }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</body>
</html>