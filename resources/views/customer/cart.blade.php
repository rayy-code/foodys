@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('user.home') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i>Kembali</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Keranjang Saya</h3>
                @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession
                <div class="table-responsive">
                    <table class="table table-striped align-middle table-hover">
                        <tbody class="table-group-divider" >
                            @php
                                $totalQty = 0;
                                $totalPay = 0;
                            @endphp
                            @foreach($carts as $item)
                            <tr>
                                
                                <td>
                                    <img src="{{ asset('storage/public/images/menu/'.$item->menu->image) }}" alt="" width="100">
                                </td>
                                <td>{{ $item->menu->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp. {{ number_format($item->menu->price,0) }}</td>
                                <td>Rp. {{ number_format($item->quantity * $item->menu->price,0) }}</td>
                                @php
                                    $totalQty += $item->quantity;
                                    $totalPay += $item->quantity * $item->menu->price;
                                @endphp
                                <td>
                                    <form action="{{ route('customer.cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus?')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @if ($totalQty !== 0)
                            <tr>
                                <td colspan="3">Total</td>
                                <td>{{ $totalQty }}</td>
                                <td>Rp. {{ number_format($totalPay,0) }}</td>
                                <td>
                                    <form action="{{ route('customer.order.payment') }}" method="get">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Pesan</button>
                                    </form>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="6" >
                                    <h3 class="text-center">Anda belum belanja</h3>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection