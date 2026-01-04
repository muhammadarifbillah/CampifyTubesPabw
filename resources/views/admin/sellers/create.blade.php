<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Tambah Penjual Baru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --blue: #2563eb;
            --green: #10b981
        }

        body {
            font-family: Inter, Segoe UI, Arial, Helvetica, sans-serif;
            background: rgba(0, 0, 0, 0.45);
            padding: 40px
        }

        .modal {
            max-width: 700px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 20px 50px rgba(2, 6, 23, 0.4)
        }

        h2 {
            margin: 0 0 8px 0
        }

        .field {
            margin-bottom: 14px
        }

        label {
            display: block;
            font-size: 13px;
            margin-bottom: 6px;
            color: #065f46
        }

        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 96%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #dcfce7;
            background: #fbfffc
        }

        select {
            appearance: none
        }

        textarea {
            min-height: 110px
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 18px
        }

        .btn-cancel {
            background: transparent;
            border: 1px solid #dcfce7;
            color: var(--green);
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none
        }

        .btn-submit {
            background: linear-gradient(90deg, var(--blue), #3b82f6);
            color: #fff;
            padding: 10px 18px;
            border-radius: 10px;
            border: none
        }

        .select-wrap {
            position: relative
        }

        .select-wrap:after {
            content: '\f0d7';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af
        }
    </style>
</head>

<body>
    <div class="modal" role="dialog" aria-modal="true">
        <form method="POST" action="{{ route('admin.sellers.store') }}">
            @csrf
            <h2>Tambah Penjual Baru</h2>
            <p style="color:#6b7280;margin-top:6px">Isi informasi toko dan pemilik</p>

            <div class="field">
                <label>User ID *</label>
                <input type="text" name="user_id" placeholder="Contoh: USR001" required>
            </div>

            <div class="field">
                <label>Nama Toko *</label>
                <input type="text" name="store_name" placeholder="Masukkan nama toko" required>
            </div>

            <div class="field">
                <label>Nama Pemilik *</label>
                <input type="text" name="owner_name" placeholder="Masukkan nama pemilik" required>
            </div>

            <div class="field">
                <label>Email *</label>
                <input type="email" name="email" placeholder="email@example.com" required>
            </div>

            <div class="field">
                <label>Deskripsi Toko *</label>
                <textarea name="store_description" placeholder="Deskripsi singkat tentang toko Anda"
                    required></textarea>
            </div>

            <div class="field select-wrap">
                <label>Status Verifikasi *</label>
                <select name="status">
                    <option value="pending">Pending</option>
                    <option value="verified">Verified</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="actions">
                <a href="{{ route('admin.sellers.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit"><i class="fas fa-plus"></i> Tambah Penjual</button>
            </div>
        </form>
    </div>
</body>

</html>