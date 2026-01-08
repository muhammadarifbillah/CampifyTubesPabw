<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Pembeli</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root{--green:#10b981;--muted:#f3faf6}
        body{font-family:Inter,Segoe UI,Arial,Helvetica,sans-serif;background:rgba(0,0,0,0.45);padding:40px}
        .modal{max-width:640px;margin:40px auto;background:#fff;border-radius:12px;padding:20px;box-shadow:0 20px 50px rgba(2,6,23,0.4)}
        h2{margin:0 0 8px 0}
        .field{margin-bottom:12px}
        label{display:block;font-size:13px;margin-bottom:6px;color:#065f46}
        input[type="text"],input[type="email"],input[type="password"],select,textarea{width:96%;padding:12px;border-radius:10px;border:1px solid #dcfce7;background:#fbfffc}
        textarea{min-height:100px}
        .row{display:flex;gap:12px}
        .row .col{flex:1}
        .actions{display:flex;gap:12px;justify-content:flex-end;margin-top:18px}
        .btn-cancel{background:transparent;border:1px solid #dcfce7;color:var(--green);padding:10px 18px;border-radius:10px;text-decoration:none}
        .btn-submit{background:linear-gradient(90deg,var(--green),#059669);color:#fff;padding:10px 18px;border-radius:10px;border:none}
        .eye{position:absolute;right:12px;top:42px;color:#9ca3af;cursor:pointer}
    </style>
</head>
<body>
    <div class="modal" role="dialog" aria-modal="true">
        <form method="POST" action="{{ route('admin.buyers.update', $buyer) }}">
            @csrf
            @method('PUT')
            <h2>Edit Pembeli</h2>
            <p style="color:#6b7280;margin-top:6px">Perbarui data pembeli</p>

            <div class="field">
                <label>Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name', $buyer->name) }}" required>
            </div>

            <div class="field">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email', $buyer->email) }}" required>
            </div>

            <div class="field" style="position:relative">
                <label>Password <small style="color:#6b7280">(kosongkan jika tidak diganti)</small></label>
                <input type="password" name="password" id="passwordFieldEdit" placeholder="Masukkan password jika ingin mengganti">
                <i class="fa-solid fa-eye eye" id="togglePwdEdit"></i>
            </div>

            <div class="field">
                <label>Role *</label>
                <select name="role" required>
                    <option value="buyer" {{ (old('role', $buyer->role)=='buyer')?'selected':'' }}>Buyer</option>
                    <option value="seller" {{ (old('role', $buyer->role)=='seller')?'selected':'' }}>Seller</option>
                    <option value="admin" {{ (old('role', $buyer->role)=='admin')?'selected':'' }}>Admin</option>
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <div class="field">
                        <label>Status *</label>
                        <select name="status">
                            <option value="active" {{ (old('status', $buyer->status ?? '')=='active')?'selected':'' }}>Active</option>
                            <option value="inactive" {{ (old('status', $buyer->status ?? '')=='inactive')?'selected':'' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="actions">
                <a href="{{ route('admin.buyers.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('togglePwdEdit').addEventListener('click', function(){
            var f = document.getElementById('passwordFieldEdit');
            if(f.type === 'password') f.type = 'text'; else f.type = 'password';
        });
    </script>
</body>
</html>