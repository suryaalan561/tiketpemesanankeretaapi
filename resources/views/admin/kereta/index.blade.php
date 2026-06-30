@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm p-4 bg-white rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary m-0">🚂 Kelola Data Kereta (Admin)</h4>
            <a href="{{ route('kereta.create') }}" class="btn btn-primary fw-bold">+ Tambah Kereta Baru</a>
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
                        <th>Nama Kereta</th>
                        <th>Kelas</th>
                        <th>Total Kursi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keretas as $k)
                        <tr>
                            <td><strong>{{ $k->nama_kereta }}</strong></td>
                            <td><span class="badge bg-info text-dark p-2">{{ $k->kelas }}</span></td>
                            <td>{{ $k->total_kursi }} Kursi</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $k->id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('kereta.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kereta ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>

                                <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $k->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-start">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="editModalLabel{{ $k->id }}">✏️ Edit Data Kereta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('kereta.update', $k->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Nama Kereta</label>
                                                        <input type="text" name="nama_kereta" class="form-control" value="{{ $k->nama_kereta }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Kelas</label>
                                                        <select name="kelas" class="form-select" required>
                                                            <option value="Ekonomi" {{ $k->kelas == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                                                            <option value="Eksekutif" {{ $k->kelas == 'Eksekutif' ? 'selected' : '' }}>Eksekutif</option>
                                                            <option value="Bisnis" {{ $k->kelas == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Total Kursi</label>
                                                        <input type="number" name="total_kursi" class="form-control" value="{{ $k->total_kursi }}" min="1" required>
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
                            <td colspan="4" class="text-center text-muted py-4">Belum ada data kereta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection