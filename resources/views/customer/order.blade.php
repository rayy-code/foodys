@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('user.home') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i>Kembali</a>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Pesanan Saya</h3>
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
                            @foreach($orders as $item)
                            @php
                                $totalPay += $item->total_price;
                            @endphp
                                @foreach ($item->orderDetail as $menu)
                                    <tr>
                                        @php
                                        
                                        $totalQty += $menu->quantity;
                                        @endphp
                                
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
                                        
                                        
                                    </tr>
                                    
                                @endforeach
                                
                                
                            
                            @endforeach
                            @if ($totalPay !== 0)
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td>{{ $totalQty }}</td>
                                    <td>Rp. {{ $totalPay }}</td>
                                    <td></td>
                                </tr>
                            @else
                            <tr>
                                <td colspan="6">Anda belum memesan atau pesanan sudah selesai</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    
    </div>
@endsection