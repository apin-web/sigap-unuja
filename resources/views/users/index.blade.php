@extends('layouts.app')

@section('page-title', 'Kelola Akun')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Akun</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-3">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM/NIP</th>
                    <th>Role</th>
                    <th>Jurusan/Departemen</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->identifier }}</td>
                        <td>
                            @if($item->role == 'admin')
                                <span class="badge bg-dark">Admin</span>
                            @elseif($item->role == 'guard')
                                <span class="badge bg-primary">Satpam</span>
                            @else
                                <span class="badge bg-secondary">Mahasiswa</span>
                            @endif
                        </td>
                        <td>{{ $item->department ?? '-' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('users.destroy', $item->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin hapus akun ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection