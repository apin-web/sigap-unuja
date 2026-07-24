@extends('layouts.app')

@section('page-title', 'Edit Akun')

@section('content')
    <div class="card p-4">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label">NIM / NIP</label>
                <input type="text" name="identifier" class="form-control" value="{{ $user->identifier }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Password (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="guard" {{ $user->role == 'guard' ? 'selected' : '' }}>Satpam</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jurusan / Departemen (opsional)</label>
                <input type="text" name="department" class="form-control" value="{{ $user->department }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection