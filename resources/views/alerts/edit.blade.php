@extends('layouts.app')

@section('page-title', 'Edit Informasi')

@section('content')
    <div class="card p-4">
        <h5 class="mb-3">Edit Informasi / Pengumuman</h5>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($alert->image_url)
            <div class="mb-3">
                <label class="form-label d-block">Gambar Saat Ini</label>
                <img src="{{ $alert->image_url }}" alt="Gambar Alert" style="max-width: 250px;" class="rounded border">
            </div>
        @endif

        <form action="{{ route('alerts.update', $alert->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $alert->title) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category" class="form-select">
                    <option value="KEHILANGAN" {{ old('category', $alert->category) == 'KEHILANGAN' ? 'selected' : '' }}>Kehilangan</option>
                    <option value="INFO_PARKIR" {{ old('category', $alert->category) == 'INFO_PARKIR' ? 'selected' : '' }}>Info Parkir</option>
                    <option value="LAINNYA" {{ old('category', $alert->category) == 'LAINNYA' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi / Deskripsi</label>
                <textarea name="content" rows="5" class="form-control">{{ old('content', $alert->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Ganti Gambar (kosongkan jika tidak ingin mengubah)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_urgent" value="1" class="form-check-input" id="isUrgent"
                       {{ old('is_urgent', $alert->is_urgent) ? 'checked' : '' }}>
                <label class="form-check-label" for="isUrgent">Tandai Sangat Penting (prioritas merah)</label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('alerts.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection