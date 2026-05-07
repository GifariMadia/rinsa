@extends('layouts.app')
@section('title', 'Tambah Pelanggan')

@section('content')
<div style="max-width:520px">
    <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem">
        <a href="{{ route('customers.index') }}" style="color:var(--rinsa-gray);text-decoration:none;font-size:.85rem">← Kembali</a>
        <h1 class="page-title" style="margin:0">Tambah Pelanggan</h1>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('customers.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-input"
                       value="{{ old('name') }}" placeholder="Nama pelanggan" required autofocus />
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">No. HP</label>
                    <input type="text" name="phone" class="form-input"
                           value="{{ old('phone') }}" placeholder="08xx" />
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="address" class="form-input"
                           value="{{ old('address') }}" placeholder="Jl. ..." />
                </div>
            </div>
            <div style="display:flex;gap:.75rem;justify-content:flex-end;margin-top:.5rem">
                <a href="{{ route('customers.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
