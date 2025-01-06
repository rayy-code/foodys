@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-2"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h3>List Kategori</h3>
                        @session('success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Berhasil! </strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endsession
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="table-responive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th id="id" scope="row">{{ $no+=1 }}</th>
                                            <td id="namaKategori">{{ $category->name }}</td>
                                            <td id="namaKategori">{{ $category->description }}</td>
                                            <td>
                                                <form action="{{ route('admin.kategori.delete', $category->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow mb-3">
                    <div class="card-body">
                        <h3>Tambah Kategori</h3>
                        <form action="" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="NamaKategori" required placeholder="Nama Kategori" class="form-control form-control-sm @error('name') is-invalid @enderror">
                                <label for="NamaKategori">Nama Kategori</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" name="description" id="deskripsi" placeholder="Deskripsi" class="form-control form-control-sm @error('description') is-invalid @enderror">
                                <label for="deskripsi">Deskripsi</label>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
