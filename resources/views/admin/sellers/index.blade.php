<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kelola Penjual</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--blue:#2563eb;--muted:#f3faf6}
        body{font-family:Inter,Segoe UI,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#f0f7ff,#fbfdff);padding:28px;color:#0b1220}
        .container{max-width:1100px;margin:0 auto}
        .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:16px}
        a{text-decoration: none;}
        h1{margin:0;color:var(--blue)}
        .subtitle{color:#2563eb;font-size:13px}
        .search{background:#fff;border-radius:12px;padding:12px;box-shadow:0 8px 20px rgba(37,99,235,0.03);display:flex;gap:12px;align-items:center}
        .search input{flex:1;padding:12px;border:1px solid #dbeafe;border-radius:8px}
        .btn-add{background:linear-gradient(90deg,#2563eb,#3b82f6);color:#fff;padding:10px 14px;border-radius:10px;border:none}
        table{width:100%;border-collapse:collapse;margin-top:18px}
        thead th{background:var(--blue);color:#fff;padding:12px;border-radius:8px;text-align:left}
        tbody td{background:#fff;padding:12px;border-bottom:8px solid #eff6ff}
        .avatar{width:36px;height:36px;border-radius:999px;background:#eff6ff;display:inline-flex;align-items:center;justify-content:center;color:var(--blue);font-weight:700;margin-right:8px}
        .pill{background:#eef2ff;color:var(--blue);padding:6px 10px;border-radius:999px;font-size:12px}
        .actions a{margin-left:8px;color:#2563eb;text-decoration:none}
        .summary{display:flex;gap:12px;margin-top:18px}
        .summary .card{flex:1;background:#fff;border-radius:10px;padding:14px;box-shadow:0 8px 20px rgba(37,99,235,0.03)}
        @media(max-width:900px){.search{flex-direction:column} .summary{flex-direction:column}}
    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <div>
                <h1>Kelola Data Penjual</h1>
                <div class="subtitle">Kelola semua data penjual dan toko di marketplace</div>
            </div>
            <div style="display:flex;gap:12px;align-items:center">
                <a href="{{ route('admin.dashboard') }}" class="btn-back" style="color:var(--blue);text-decoration:none"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
                <a href="{{ route('admin.sellers.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah Penjual</a>
            </div>
        </div>

        <div class="search">
            <i class="fas fa-search" style="color:#9ca3af"></i>
            <input placeholder="Cari penjual berdasarkan nama toko, pemilik, atau email...">
        </div>

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Nama Toko</th>
                    <th>Nama Pemilik</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $s)
                    <tr>
                        <td>{{ $s->user_id ?? ('USR'.str_pad($s->id,3,'0',STR_PAD_LEFT)) }}</td>
                        <td><span class="avatar">{{ strtoupper(substr($s->store_name,0,1)) }}</span> {{ $s->store_name }}</td>
                        <td>{{ $s->owner_name }}</td>
                        <td>{{ $s->email }}</td>
                        <td>{{ $s->created_at->format('j M Y') }}</td>
                        <td>
                            @if(($s->status ?? 'pending')=='verified')
                                <span class="pill" style="background:#ecfdf5;color:#065f46">Verified</span>
                            @elseif(($s->status ?? '')=='pending')
                                <span class="pill" style="background:#fff7ed;color:#d97706">Pending</span>
                            @elseif(($s->status ?? '')=='rejected')
                                <span class="pill" style="background:#fff1f2;color:#b91c1c">Rejected</span>
                            @else
                                <span class="pill">{{ ucfirst($s->status) }}</span>
                            @endif
                        </td>
                        <td class="actions">
                            <a href="{{ route('admin.sellers.edit', $s) }}"><i class="fas fa-pen" style="color:#2563eb"></i></a>
                            {{-- activation button removed per request --}}
                            <form method="POST" action="{{ route('admin.sellers.destroy', $s) }}" style="display:inline;margin-left:8px">@csrf @method('DELETE')<button type="submit" style="background:none;border:none;color:#ef4444"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div class="card">Total Penjual<br><strong>{{ $totals['sellers'] ?? $sellers->count() }}</strong></div>
            <div class="card">Terverifikasi<br><strong>{{ $totals['verified_sellers'] ?? 0 }}</strong></div>
            <div class="card">Menunggu Verifikasi<br><strong>{{ $totals['pending_sellers'] ?? 0 }}</strong></div>
        </div>
    </div>
</body>
</html>