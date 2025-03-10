<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ public_path('css/bs.css') }}"> --}}
    <title>{{ $title }}</title>
</head>
<body>
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Riwayat Pesanan</h3>
                <div class="table-responsive">
                    <table class="table table-striped align-middle table-hover table-bordered" border="1">
                        <thead>
                            <th scope="col" >#</th>

                            <th scope="col" >Tanggal Order</th>
                            <th scope="col" colspan="2" >Makanan</th>
                            <th scope="col" >Harga Makanan</th>
                            <th scope="col" >Kuantitas</th>
                            <th scope="col" >Total</th>


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
                                        <td class="text-center" >{{ $no+=1 }}</td>

                                        <td class="text-center">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                        <td class="text-center">
                                            <img src="{{ public_path('storage/public/images/menu/'.$menu->menuItem->image) }}" alt="" width="100">
                                        </td>

                                        <td class="text-center">
                                            {{ $menu->menuItem->name }}
                                        </td>
                                        <td class="text-center">
                                            Rp. {{ number_format($menu->menuItem->price, 0) }}
                                        </td>
                                        <td class="text-center">
                                            {{ $menu->quantity }}
                                        </td>
                                        <td class="text-center">
                                            Rp. {{ number_format($menu->price, 0) }}
                                        </td>
                                    </tr>

                                @endforeach



                            @endforeach
                            @if ($totalPay !== 0)
                                <tr>
                                    <td colspan="6">Total</td>

                                    <td class="text-center">Rp. {{ number_format($totalPay,0) }}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                            <tr>
                                <td colspan="7">Belum ada pesanan</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
</body>
</html>
