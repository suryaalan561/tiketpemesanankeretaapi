<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KAI Simple</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center" style="height: 100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card border-0 shadow rounded-3 p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">🚂 KAI Simple</h3>
                    <small class="text-muted">Silakan masuk ke akun Anda</small>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger py-2 small border-0">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success py-2 small border-0 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="******" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm mt-2 mb-3">Masuk Sistem</button>
                    
                    <div class="text-center">
                        <small class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Daftar Akun Baru</a></small>
                    </div>
                </form>

                <div class="mt-4 p-2 bg-light rounded text-center small text-muted">
                    <strong>Akun Uji Coba (Dari Seeder):</strong><br>
                    <span class="d-block text-start mt-1">🔑 **Admin:** admin@kai.com / password123</span>
                    <span class="d-block text-start">🔑 **Penumpang:** budi@email.com / password123</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>