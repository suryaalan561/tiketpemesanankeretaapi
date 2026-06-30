@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm p-4 bg-white rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary m-0">🚉 Kelola Data Stasiun (Admin)</h4>
            <a href="{{ route('stasiun.create') }}" class="btn btn-primary fw-bold">+ Tambah Stasiun Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-3">
                🎉 {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Kode Stasiun</th>
                        <th>Nama Stasiun</th>
                        <th>Kota</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stasiuns as $s)
                        <tr>
                            <td><span class="badge bg-secondary font-weight-bold p-2">{{ $s->kode_stasiun }}</span></td>
                            <td><strong>{{ $s->nama_stasiun }}</strong></td>
                            <td>{{ $s->kota }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('stasiun.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus stasiun ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>

                                <div class="modal fade" id="editModal{{ $s->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $s->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-start">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="editModalLabel{{ $s->id }}">✏️ Edit Data Stasiun</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('stasiun.update', $s->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Kode Stasiun</label>
                                                        <input type="text" name="kode_stasiun" class="form-control" value="{{ $s->kode_stasiun }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Nama Stasiun</label>
                                                        <input type="text" name="nama_stasiun" class="form-control" value="{{ $s->nama_stasiun }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Kota</label>
                                                        <input type="text" name="kota" class="form-control" value="{{ $s->kota }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary fw-bold">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data stasiun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection