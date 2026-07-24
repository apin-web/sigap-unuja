@extends('layouts.app')

@section('page-title', 'Informasi / Pengumuman')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('alerts.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Informasi</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3 shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="50">No</th>
                        <th width="80">Foto</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Isi</th>
                        <th width="90">Prioritas</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->image_url)
                                    <a href="{{ $item->image_url }}" target="_blank" title="Klik untuk lihat foto">
                                        <img src="{{ $item->image_url }}" style="width:45px;height:45px;object-fit:cover;" class="rounded border shadow-sm" alt="Foto">
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td><strong>{{ $item->title }}</strong></td>
                            <td>
                                @if($item->category == 'KEHILANGAN')
                                    <span class="badge bg-secondary">Kehilangan</span>
                                @elseif($item->category == 'INFO_PARKIR')
                                    <span class="badge bg-info text-dark">Info Parkir</span>
                                @else
                                    <span class="badge bg-primary">Lainnya</span>
                                @endif
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($item->content, 50, '...') }}</td>
                            <td>
                                @if($item->is_urgent)
                                    <span class="badge bg-danger">Penting</span>
                                @else
                                    <span class="badge bg-light text-dark border">Biasa</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('alerts.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('alerts.destroy', $item->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus informasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Belum ada informasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection