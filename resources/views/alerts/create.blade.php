@extends('layouts.app')

@section('page-title', 'Tambah Informasi')

@section('content')
    <div class="card p-4">
        <h5 class="mb-3">Tambah Informasi / Pengumuman</h5>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('alerts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category" class="form-select">
                    <option value="KEHILANGAN" {{ old('category') == 'KEHILANGAN' ? 'selected' : '' }}>Kehilangan</option>
                    <option value="INFO_PARKIR" {{ old('category') == 'INFO_PARKIR' ? 'selected' : '' }}>Info Parkir</option>
                    <option value="LAINNYA" {{ old('category') == 'LAINNYA' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi / Deskripsi</label>
                <textarea name="content" rows="5" class="form-control">{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Lampiran Gambar (opsional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_urgent" value="1" class="form-check-input" id="isUrgent">
                <label class="form-check-label" for="isUrgent">Tandai Sangat Penting (prioritas merah)</label>
            </div>

            <button type="submit" class="btn btn-primary">Sebarkan</button>
            <a href="{{ route('alerts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection