@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('user.home') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i>Kembali</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Riwayat Pesanan</h3>
                @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endsession
                <div class="table-responsive">
                    <table class="table table-striped align-middle table-hover">
                        <thead>
                            <th scope="col" >#</th>
                            <th scope="col" >Order ID</th>
                            <th scope="col" >Tanggal Order</th>
                            <th scope="col" colspan="2" >Makanan</th>
                            <th scope="col" >Harga Makanan</th>
                            <th scope="col" >Kuantitas</th>
                            <th scope="col" >Total</th>
                            <th scope="col" >Status</th>
                            <th scope="col" >Terakhir Diubah</th>
                        </thead>
                        <tbody class="table-group-divider" >
                            
                            @php
                                
                                $totalPay = 0;
                                $no = 0;
                            @endphp
                            @foreach($orders as $item)
                                @php
                                    $totalPay += $item->total_price;
                                @endphp
                                @foreach ($item->orderDetail as $menu)
                                    <tr>
                                        <td>{{ $no+=1 }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <img src="{{ asset('storage/public/images/menu/'.$menu->menuItem->image) }}" alt="" width="100">
                                        </td>
                                        
                                        <td>
                                            {{ $menu->menuItem->name }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($menu->menuItem->price, 0) }}
                                        </td>
                                        <td>
                                            {{ $menu->quantity }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($menu->price, 0) }}
                                        </td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->updated_at->format('d M Y, H:i') }}</td>
                                        
                                    </tr>
                                    
                                @endforeach
                                
                                
                            
                            @endforeach
                            @if ($totalPay !== 0)
                                <tr>
                                    <td colspan="7">Total</td>
                                    
                                    <td>Rp. {{ number_format($totalPay,0) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                            <tr>
                                <td colspan="7">Belum ada pesanan</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </tfoot>
                    </table>
                </div>

            </div>
        </div>
    
    </div>
@endsection