@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-4">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('admin.dashboard') }}" class="m-1 btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
                <div class="table-responsive">
                    <table class="table table-bordered align-middle table-stripped">
                        <thead class="text-center" >
                            <th scope="col">#</th>
                            <th scope="col">ID Pesanan</th>
                            <th scope="col" colspan="2" class="text-center">Makanan</th>
                            <th scope="col">Kuantitas</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 0;
                            @endphp
                            @foreach($pesanan as $item)
                            @foreach ($item->orderDetail as $menu)
                                
                            
                            <tr class="text-center" >
                                <td>{{ $no+=1 }}</td>
                                <td>{{ $item->id }}</td>
                                <td class="text-center" >
                                    <img src="{{ asset('storage/public/images/menu/'.$menu->menuItem->image) }}" width="100" height=""/>
                                </td>
                                <td>{{ $menu->menuItem->name }}</td>
                                
                                <td>{{ $menu->quantity }}</td>
                                <td>Rp. {{ number_format($menu->price, 0) }}</td>
                                
                                @if ( $item->status === 'pending' )
                                <td>
                                    <h2><i class="bi bi-clock-history text-danger"></i></h2>
                                    <small class="text-danger">{{ $item->status }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.update', $item->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Lanjutkan proses?')"><i class="bi bi-arrow-right"></i></button>
                                    </form>
                                </td>
                                @endif
                                @if ( $item->status === 'process' )
                                <td>
                                    <h2><i class="bi bi-hourglass-split text-primary"></i></h2>
                                    <small class="text-primary">{{ $item->status }}</small>
                                </td>
                                <td>
                                    <form action="{{ route('admin.orders.update', $item->id) }}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Proses sudah selesai?')"><i class="bi bi-check"></i></button>
                                    </form>
                                </td>
                                @endif
                                @if ( $item->status === 'done' )
                                <td>
                                    <h2><i class="bi bi-check-circle-fill text-success"></i></h2>
                                    <small class="text-success">{{ $item->status }}</small>
                                </td>
                                <td>Selesai</td>
                                @endif
                                
                                
                            </tr>
                            @endforeach
                            @endforeach
                            @if ($no === 0)
                                <tr class="text-center" >
                                    <td colspan="8" >Belum ada pesanan masuk atau semua pesanan sudah selsai</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection