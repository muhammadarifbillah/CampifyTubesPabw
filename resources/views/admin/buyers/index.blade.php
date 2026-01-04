<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kelola Pembeli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green:#10b981;--muted:#f3faf6}
        body{font-family:Inter,Segoe UI,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#f0fdf4,#fbfffb);padding:28px;color:#0b1220}
        .container{max-width:1100px;margin:0 auto}
        .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
        a{text-decoration: none;}
        h1{margin:0;color:var(--green)}
        .subtitle{color:#065f46;font-size:13px}
        

        .search{background:#fff;border-radius:12px;padding:12px;box-shadow:0 8px 20px rgba(4,120,87,0.03);display:flex;gap:12px;align-items:center}
        .search input{flex:1;padding:12px;border:1px solid #dcfce7;border-radius:8px}
        .btn-add{background:linear-gradient(90deg,var(--green),#059669);color:#fff;padding:10px 14px;border-radius:10px;border:none}

        table{width:100%;border-collapse:collapse;margin-top:18px}
        thead th{background:var(--green);color:#fff;padding:12px;border-radius:8px;text-align:left}
        tbody td{background:#fff;padding:12px;border-bottom:8px solid #f0fff6}
        .avatar{width:36px;height:36px;border-radius:999px;background:#ecfdf5;display:inline-flex;align-items:center;justify-content:center;color:var(--green);font-weight:700;margin-right:8px}
        .pill{background:#eefaf0;color:var(--green);padding:6px 10px;border-radius:999px;font-size:12px}
        .actions a{margin-left:8px;color:#0ea5a4;text-decoration:none}

        .summary{display:flex;gap:12px;margin-top:18px}
        .summary .card{flex:1;background:#fff;border-radius:10px;padding:14px;box-shadow:0 8px 20px rgba(4,120,87,0.03)}

        @media(max-width:900px){.search{flex-direction:column} .summary{flex-direction:column}}
    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <div>
                <h1>Kelola Data Pembeli</h1>
                <div class="subtitle">Kelola semua data pembeli di marketplace</div>
            </div>
            <div style="display:flex;gap:12px;align-items:center">
                <a href="{{ route('admin.dashboard') }}" class="btn-back" style="color:var(--green);text-decoration:none"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
                <a href="{{ route('admin.buyers.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah Pembeli</a>
            </div>
        </div>

        <div class="search">
            <i class="fas fa-search" style="color:#9ca3af"></i>
            <input placeholder="Cari pembeli berdasarkan nama atau email...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buyers as $b)
                    <tr>
                        <td><span class="avatar">{{ strtoupper(substr($b->name,0,1)) }}</span> {{ $b->name }}</td>
                        <td>{{ $b->email }}</td>
                        <td><span class="pill">{{ $b->role ?? 'buyer' }}</span></td>
                        <td>{{ $b->created_at->format('j M Y') }}</td>
                        <td>@if($b->is_active ?? true)<span class="pill">Active</span>@else<span class="pill" style="background:#fff3cd;color:#b45309">Inactive</span>@endif</td>
                        <td class="actions">
                            <a href="{{ route('admin.buyers.edit', $b) }}"><i class="fas fa-pen" style="color:#0ea5a4"></i></a>
                            <form method="POST" action="{{ route('admin.buyers.destroy', $b) }}" style="display:inline">@csrf @method('DELETE')<button type="submit" style="background:none;border:none;color:#ef4444"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="card">Total Pembeli<br><strong>{{ $totals['buyers'] ?? $buyers->count() }}</strong></div>
            <div class="card">Pembeli Aktif<br><strong>{{ $totals['active_buyers'] ?? 0 }}</strong></div>
            <div class="card">Pembeli Tidak Aktif<br><strong>{{ $totals['inactive_buyers'] ?? 0 }}</strong></div>
        </div>
    </div>
</body>
</html>