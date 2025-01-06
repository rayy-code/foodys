@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession
        <a href="{{ route('user.home') }}" class="mb-2 btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
         <div class="row align-items-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2><i class="bi bi-person-circle"></i> Profile</h2>
                        <form action="{{ route('customer.profile.update', $customer->id) }}" enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3 row">
                                <label for="namaUser" class="col-form-label col-sm-3">Nama</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" id="namaUser" required value="{{ $customer->customer->name }}">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="noTelp" class="col-form-label col-sm-3">Nomor Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone_number" id="noTelp" required value="{{ $customer->phone_number }}">
                                </div>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="imgProfile" class="col-form-label col-sm-3">Foto Profil</label>
                                <div class="col-sm-9">
                                    <input type="file" value="{{ $customer->img_profile }}" class="form-control" id="imgProfile" name="img_profile">
                                </div>
                                @error('img_profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="alamat" class="col-form-label col-sm-3">Alamat</label>
                                <div class="col-sm-9">
                                    <Textarea class="form-control" id="alamat" name="address" >{{ $customer->address }}</Textarea>
                                </div>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-3 justify-content-end">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="{{ asset('storage/public/images/profile/'.$customer->img_profile ) }}" style="max-width: inherit;" alt="" class="rounded">
            </div>
         </div>
    </div>
@endsection