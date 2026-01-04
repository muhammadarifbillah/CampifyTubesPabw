<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profil Toko</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{
            --green:#059669; /* stronger primary */
            --accent:#047857; /* darker accent */
            --muted:#ecfdf5;
            --card:#ffffff;
            --text:#0f172a;
        }
        body{font-family:Inter,Segoe UI,Arial,Helvetica,sans-serif;background:linear-gradient(180deg,#f0fdf4 0%, #f6fbf9 100%);padding:24px;color:var(--text)}
        .wrap{max-width:980px;margin:0 auto}
        .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
        h1{margin:0;font-size:20px;color:var(--accent);display:inline-flex;align-items:center;gap:10px}
        .btn-save{background:linear-gradient(90deg,var(--green),var(--accent));color:#fff;padding:10px 16px;border-radius:10px;border:none;box-shadow:0 6px 18px rgba(4,120,87,0.12);display:inline-flex;align-items:center;gap:8px}
        .btn-save:hover{filter:brightness(0.98);transform:translateY(-1px)}

        .card{background:var(--card);border-radius:12px;padding:18px;border-left:4px solid rgba(4,120,87,0.06);box-shadow:0 10px 30px rgba(4,120,87,0.05);margin-bottom:16px}
        .card h3{margin:0 0 12px 0;color:var(--accent);display:flex;align-items:center;gap:10px}

        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        label{display:block;font-size:13px;margin-bottom:6px;color:#065f46}
        input[type="text"], input[type="email"], input[type="time"], textarea, select{width:100%;padding:10px;border:1px solid #bbf7d0;border-radius:10px;background:#fbfffcf0;outline:none}
        input[type="text"]:focus, input[type="email"]:focus, textarea:focus, select:focus{box-shadow:0 0 0 4px rgba(5,150,105,0.08);border-color:var(--accent)}
        textarea{min-height:110px}

        .upload{border:2px dashed #bbf7d0;padding:20px;border-radius:10px;text-align:center;color:var(--accent);background:linear-gradient(180deg,#ffffff,#f8fffb)}
        .upload small{color:#065f46}
        .small-input{padding:8px}

        .section{margin-bottom:12px}

        .full-row{grid-column:1/-1}

        .actions{display:flex;gap:8px;justify-content:flex-end;margin-top:12px}
        .btn-back{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:8px;border:1px solid rgba(4,120,87,0.09);background:transparent;color:var(--accent);text-decoration:none}
        .btn-back i{font-size:14px}
    </style>
</head>
<body>
    <div class="wrap">
        <div class="top">
            <div style="display:flex;align-items:center;gap:12px">
                <a href="{{ route('seller.dashboard') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
                <div>
                    <h1><i class="fas fa-store" style="color:var(--green)"></i> Profil Toko</h1>
                    <div style="color:#4b5563;font-size:13px">Kelola informasi lengkap toko Anda</div>
                </div>
            </div>
            <div>
                <button form="profileForm" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </div>

        <form id="profileForm" method="POST" action="{{ route('seller.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <h3><i class="fas fa-info-circle" style="color:var(--green)"></i> Informasi Toko</h3>
                <div class="grid-2">
                    <div>
                        <label>Nama Toko *</label>
                        <input type="text" name="store_name" value="{{ old('store_name', $seller->store_name ?? '') }}" required>
                    </div>
                    <div>
                        <label>Status Toko</label>
                        <select name="status">
                            <option value="open" {{ (old('status', $seller->status ?? '')=='open')?'selected':'' }}>Buka</option>
                            <option value="closed" {{ (old('status', $seller->status ?? '')=='closed')?'selected':'' }}>Tutup</option>
                            <option value="holiday" {{ (old('status', $seller->status ?? '')=='holiday')?'selected':'' }}>Libur</option>
                        </select>
                    </div>

                    <div class="full-row">
                        <label>Deskripsi Toko</label>
                        <textarea name="store_description">{{ old('store_description', $seller->store_description ?? '') }}</textarea>
                    </div>

                    <div>
                        <label>Logo Toko (PNG/JPG, max 2MB)</label>
                        <input type="file" name="logo" accept="image/*" class="small-input">
                    </div>
                    <div>
                        <label></label>
                        <!-- placeholder for current logo preview -->
                        @if(!empty($seller->logo))
                            <img src="{{ asset('storage/'.$seller->logo) }}" alt="logo" style="max-height:64px;border-radius:8px">
                        @endif
                    </div>
                </div>
            </div>

            <div class="card">
                <h3><i class="fas fa-phone" style="color:var(--green)"></i> Kontak & Lokasi</h3>
                <div class="grid-2">
                    <div>
                        <label>Nama Pemilik *</label>
                        <input type="text" name="owner_name" value="{{ old('owner_name', $seller->owner_name ?? '') }}">
                    </div>
                    <div>
                        <label>Email Toko *</label>
                        <input type="email" name="email" value="{{ old('email', $seller->email ?? '') }}">
                    </div>

                    <div>
                        <label>Nomor Telepon *</label>
                        <input type="text" name="phone" value="{{ old('phone', $seller->phone ?? '') }}">
                    </div>
                    <div>
                        <label>Kota</label>
                        <input type="text" name="city" value="{{ old('city', $seller->city ?? '') }}">
                    </div>

                    <div class="full-row">
                        <label>Alamat Lengkap</label>
                        <input type="text" name="address" value="{{ old('address', $seller->address ?? '') }}">
                    </div>

                    <div>
                        <label>Provinsi</label>
                        <input type="text" name="province" value="{{ old('province', $seller->province ?? '') }}">
                    </div>
                    <div>
                        <label>Kode Pos</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $seller->postal_code ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="card">
                <h3><i class="fas fa-clock" style="color:var(--green)"></i> Operasional Toko</h3>
                <div class="grid-2">
                    <div>
                        <label>Jam Buka</label>
                        <input type="time" name="open_time" value="{{ old('open_time', $seller->open_time ?? '08:00') }}">
                    </div>
                    <div>
                        <label>Jam Tutup</label>
                        <input type="time" name="close_time" value="{{ old('close_time', $seller->close_time ?? '22:00') }}">
                    </div>

                    <div class="full-row">
                        <label>Hari Operasional</label>
                        <input type="text" name="operational_days" value="{{ old('operational_days', $seller->operational_days ?? '') }}" placeholder="Senin,Selasa,...">
                    </div>

                    <div class="full-row">
                        <label>Estimasi Pengiriman</label>
                        <input type="text" name="shipping_estimate" value="{{ old('shipping_estimate', $seller->shipping_estimate ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="card">
                <h3><i class="fas fa-image" style="color:var(--green)"></i> Branding & Media</h3>
                <div class="grid-2">
                    <div class="full-row">
                        <label>Banner Toko</label>
                        <div class="upload">Klik untuk upload atau drag and drop<br><small>PNG, JPG (Rekomendasi: 1200x400px)</small>
                            <input type="file" name="banner" accept="image/*" style="margin-top:8px">
                        </div>
                    </div>

                    <div class="full-row">
                        <label>Foto Toko (Maksimal 5)</label>
                        <input type="file" name="photos[]" accept="image/*" multiple>
                    </div>

                    <div>
                        <label>Slogan Toko</label>
                        <input type="text" name="slogan" value="{{ old('slogan', $seller->slogan ?? '') }}">
                    </div>
                    <div>
                        <label>Warna Tema Toko</label>
                        <input type="text" name="theme_color" value="{{ old('theme_color', $seller->theme_color ?? '#10b981') }}">
                    </div>
                </div>
            </div>

            <div class="card">
                <h3><i class="fas fa-hashtag" style="color:var(--green)"></i> Sosial Media</h3>
                <div class="grid-2">
                    <div>
                        <label>Instagram</label>
                        <input type="text" name="instagram" value="{{ old('instagram', $seller->instagram ?? '') }}">
                    </div>
                    <div>
                        <label>Facebook</label>
                        <input type="text" name="facebook" value="{{ old('facebook', $seller->facebook ?? '') }}">
                    </div>

                    <div>
                        <label>TikTok</label>
                        <input type="text" name="tiktok" value="{{ old('tiktok', $seller->tiktok ?? '') }}">
                    </div>
                    <div>
                        <label>Website</label>
                        <input type="text" name="website" value="{{ old('website', $seller->website ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="actions">
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Semua Perubahan</button>
            </div>
        </form>
    </div>
</body>

</html>