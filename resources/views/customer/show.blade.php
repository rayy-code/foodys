@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('user.home') }}" class="m-1 btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
        <div class="row align-items-center">
            <h3>{{ $menu->name }}</h3>
            @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>:</td>
                                        <td>{{ $menu->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Makanan</th>
                                        <td>:</td>
                                        <td>{{ $menu->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Kategori</th>
                                        <td>:</td>
                                        <td>{{ $menu->menu->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Harga</th>
                                        <td>:</td>
                                        <td>Rp. {{ $menu->price}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Deskripsi</th>
                                        <td>:</td>
                                        <td>{{ $menu->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('customer.cart.store',$menu->id) }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="totalPesan">Kuantitas</span>
                                <input type="number" min="1" value="1" class="form-control" name="quantity" aria-describedby="totalPesan">
                              </div>
                            <button type="submit" class="btn btn-primary">Masukkan Ke keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/public/images/menu/'.$menu->image) }}" style="max-width: inherit" alt="">
            </div>
        </div>
    </div>

@endsection