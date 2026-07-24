@extends('layouts.app')

@section('content')
    <h3>Edit Informasi Keamanan</h3>

    <form action="{{ route('informasi.update', $informasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Isi Informasi</label>
            <textarea name="isi_informasi" rows="5" class="form-control">{{ $informasi->isi_informasi }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection