@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card border-0 shadow-sm p-4 bg-white rounded">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-primary m-0">📅 Kelola Jadwal Rute Kereta (Admin)</h4>
            <a href="{{ route('jadwal.create') }}" class="btn btn-primary fw-bold">+ Tambah Rute Baru</a>
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
                        <th>Nama Kereta (Kelas)</th>
                        <th>Stasiun Asal</th>
                        <th>Stasiun Tujuan</th>
                        <th>Waktu Berangkat</th>
                        <th>Waktu Tiba</th>
                        <th>Harga Tiket</th>
                        <th class="text-center font-weight-bold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwals as $j)
                        <tr>
                            <td>
                                <strong>{{ $j->kereta->nama_kereta }}</strong>
                                <small class="text-muted d-block">{{ $j->kereta->kelas }}</small>
                            </td>
                            <td>{{ $j->stasiunAsal->nama_stasiun }} ({{ $j->stasiunAsal->kode_stasiun }})</td>
                            <td>{{ $j->stasiunTujuan->nama_stasiun }} ({{ $j->stasiunTujuan->kode_stasiun }})</td>
                            <td>{{ \Carbon\Carbon::parse($j->waktu_berangkat)->format('d M Y, H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($j->waktu_tiba)->format('d M Y, H:i') }}</td>
                            <td class="text-danger fw-bold">Rp {{ number_format($j->harga_tiket, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-warning text-white fw-bold" data-bs-toggle="modal" data-bs-target="#editModal{{ $j->id }}">
                                        Edit
                                    </button>

                                    <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus rute ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>

                                <div class="modal fade" id="editModal{{ $j->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $j->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content text-start">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="editModalLabel{{ $j->id }}">✏️ Edit Jadwal Rute Kereta</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('jadwal.update', $j->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label fw-bold">Nama Kereta</label>
                                                            <select name="kereta_id" class="form-select" required>
                                                                @foreach($keretas as $kereta)
                                                                    <option value="{{ $kereta->id }}" {{ $j->kereta_id == $kereta->id ? 'selected' : '' }}>
                                                                        {{ $kereta->nama_kereta }} ({{ $kereta->kelas }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Stasiun Asal</label>
                                                            <select name="stasiun_asal_id" class="form-select" required>
                                                                @foreach($stasiuns as $stasiun)
                                                                    <option value="{{ $stasiun->id }}" {{ $j->stasiun_asal_id == $stasiun->id ? 'selected' : '' }}>
                                                                        {{ $stasiun->nama_stasiun }} ({{ $stasiun->kode_stasiun }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Stasiun Tujuan</label>
                                                            <select name="stasiun_tujuan_id" class="form-select" required>
                                                                @foreach($stasiuns as $stasiun)
                                                                    <option value="{{ $stasiun->id }}" {{ $j->stasiun_tujuan_id == $stasiun->id ? 'selected' : '' }}>
                                                                        {{ $stasiun->nama_stasiun }} ({{ $stasiun->kode_stasiun }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Waktu Berangkat</label>
                                                            <input type="datetime-local" name="waktu_berangkat" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($j->waktu_berangkat)) }}" required>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label fw-bold">Waktu Tiba</label>
                                                            <input type="datetime-local" name="waktu_tiba" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($j->waktu_tiba)) }}" required>
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                                                            <input type="number" name="harga_tiket" class="form-control" value="{{ (int)$j->harga_tiket }}" min="0" required>
                                                        </div>
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
                            <td colspan="7" class="text-center text-muted py-4">Belum ada jadwal rute yang dibuat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection