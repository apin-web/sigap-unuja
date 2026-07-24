@extends('layouts.app')

@section('page-title', 'Laporan Mahasiswa')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3 shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th>Pelapor</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th width="80">Foto</th>
                        <th width="100">Lokasi</th>
                        <th width="110">Status</th>
                        <th width="200">Ubah Status</th>
                        <th width="90">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>
                            <td><strong>{{ $item->title }}</strong></td>
                            
                            <td>
                                {{ \Illuminate\Support\Str::limit($item->content, 35, '...') }}
                            </td>

                            <td>
                                @if($item->image_url)
                                    <a href="{{ $item->image_url }}" target="_blank" title="Klik untuk lihat foto">
                                        <img src="{{ $item->image_url }}" style="width:45px;height:45px;object-fit:cover;" class="rounded border shadow-sm" alt="Foto Bukti">
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>

                            <td>
                                <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                    📍 Peta
                                </a>
                            </td>

                            <td>
                                @if($item->status == 'PENDING')
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @elseif($item->status == 'DIPROSES')
                                    <span class="badge bg-info text-dark">DIPROSES</span>
                                @else
                                    <span class="badge bg-success">SELESAI</span>
                                @endif
                            </td>

                            <td>
                                <form action="{{ route('reports.updateStatus', $item->id) }}" method="POST" class="d-flex gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="PENDING" {{ $item->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                        <option value="DIPROSES" {{ $item->status == 'DIPROSES' ? 'selected' : '' }}>DIPROSES</option>
                                        <option value="SELESAI" {{ $item->status == 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </form>
                            </td>

                            <td>
                                <button type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                                    👁️ Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center">Belum ada laporan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    @foreach ($data as $item)
        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">📌 Detail Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-start">
                        <p class="mb-1"><strong>Judul:</strong> {{ $item->title }}</p>
                        <p class="mb-1"><strong>Pelapor:</strong> {{ $item->user->name ?? '-' }}</p>
                        <p class="mb-3"><strong>Status:</strong> {{ $item->status }}</p>
                        
                        <hr>
                        <h6><strong>Deskripsi Lengkap:</strong></h6>
                        <div class="p-3 bg-light rounded border mb-3" style="white-space: pre-line; max-height: 200px; overflow-y: auto;">
                            {{ $item->content }}
                        </div>

                        <h6><strong>Foto Bukti:</strong></h6>
                        @if($item->image_url)
                            <div class="text-center">
                                <a href="{{ $item->image_url }}" target="_blank">
                                    <img src="{{ $item->image_url }}" class="img-fluid rounded border shadow-sm" alt="Foto Bukti" style="max-height: 300px; width: 100%; object-fit: cover;">
                                </a>
                                <small class="text-muted d-block mt-2">Klik foto untuk membuka di tab baru</small>
                            </div>
                        @else
                            <p class="text-muted bg-light p-3 rounded text-center">📷 Tidak ada foto bukti</p>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection