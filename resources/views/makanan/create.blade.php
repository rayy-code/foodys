@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-3">
            <div class="col-md-8">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-2"><i class="bi bi-arrow-left"></i> Kembali</a>
                @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession
                <div class="card shadow">
                    <div class="card-header bg-success">
                        <h3 class="fw-bold text-white">Makanan Baru</h3>
                    </div>
                    <div class="card-body p-3">
                        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" placeholder="Nama Makanan" name="name" id="namaMakanan" required autofocus class="form-control @error('name') is-invalid @enderror">
                                        <label for="namaMakanan">Nama Makanan<small class="text-danger">*</small></label>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="number" name="price" placeholder="Rp. xxxxxx" id="price" class="form-control @error('price') is-invalid @enderror" required>
                                        <label for="price">Harga<small class="text-danger">*</small></label>
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="category_id" id="idKategori" required class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="idKategori">Kategori<small class="text-danger">*</small></label>
                                    </div>
                                    @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <label class="input-group-text" for="gambar">Gambar</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" placeholder="Gambar makanan" name="image" id="gambar">
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                        <textarea placeholder="Deskripsi" class="form-control @error('description') is-invalid @enderror" id="Deskripsi" name="description"></textarea>
                                        <label for="Deskripsi">Deskripsi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan <i class="bi bi-floppy"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection