<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - KAI Simple</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #64748b;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-register {
            border: none;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            background-color: #ffffff;
        }
        .btn-primary {
            background-color: #3b82f6;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2563eb;
        }
    </style>
</head>
<body>

    <div class="card card-register p-4">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary mb-1">🚂 KAI Simple</h4>
            <small class="text-muted">Pendaftaran Akun Baru Penumpang</small>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 border-0 mb-3" style="font-size: 0.85rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Nomor Telepon</label>
                <input type="text" name="telepon" class="form-control" placeholder="Contoh: 08123322334" required value="{{ old('telepon') }}">
            </div>
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password Anda" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-3 mb-3">Daftar Sekarang</button>
            
            <div class="text-center">
                <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Log In di sini</a></small>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>