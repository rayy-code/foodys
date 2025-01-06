@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Dashboard</h1>
        <hr>
        <div class="row mb-3">
            <h3>Ringkasan</h3>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0 "><i class="bi bi-card-list"></i> Total Data</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $total =0;
                        @endphp
                        @foreach ($makanan as $item)
                           @php
                               $total += 1;
                           @endphp
                        @endforeach
                      
                        <p class="card-text">{{ $total }} Jenis Makanan</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0 "><i class="bi bi-cash-stack"></i> Total Pendapatan</h5>
                    </div>
                    <div class="card-body">
                        
                        <p class="card-text">Rp. {{ number_format($revenue,0) }}</p>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
        <div class="row">
            <div class="col-md-12">
                <h3 class="">Data Makanan</h3>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-outline-primary"><i class="bi bi-plus-circle-fill"></i> Makanan Baru</a>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle table-hover">
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">Gambar Makanan</th>
                                    <th scope="col">Nama Makanan</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Aksi</th>
                                </thead>
                                <tbody class="table-group-divider" >
                                    @php
                                        $no = 0;
                                    @endphp
                                    @foreach($makanan as $item)
                                    <tr>
                                        <td>{{ $no+=1 }}</td>
                                        <td>
                                            <img src="{{ asset('storage/public/images/menu/'.$item->image) }}" alt="" width="100">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>Rp. {{ number_format($item->price,0) }}</td>
                                        <td>{{ $item->menu->name }}</td>
                                        <td>
                                            <a title="Edit {{ $item->name }}" href="{{ route('admin.menu.edit', $item->id) }}" class="btn btn-sm btn-success m-1"><i class="bi bi-pencil"></i></a>
                                            
                                            <form action="{{ route('admin.menu.delete',$item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $makanan->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection