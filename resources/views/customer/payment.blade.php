@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8 justify-content-center">
                <div class="card shadow p-2">
                    <img src="{{ asset('images/frame.png') }}" alt="" class="card-img-top">
                    <div class="card-body text-center">
                        <h3>PT. FOODYS INDONESIA</h3>
                        <small class="text-secondary">PT. Foodys Indonesia is a company that specializes in food and beverage products.
                            We are committed to providing high-quality products that meet the needs of our customers.
                            Our products are made with the finest ingredients and are carefully crafted to ensure that they are safe and
                            delicious to eat.</small>
                        @php
                            $total_price =0;
                        @endphp
                        @foreach ($carts as $order)
                            @php
                                $total_price += $order->menu->price * $order->quantity
                            @endphp
                        @endforeach
                        <p class="mb-0 text-black">
                            Silahkan lakukan pembayaran sebesar <span class="text-success">Rp. {{ number_format($total_price,0) }}</span>
                        </p>
                        <small>Jika sudah melakukan pembayaran, <code>Admin</code> akan memvalidasi pesanan</small>
                    </div>
                    <div class="card-footer bg-light d-flex flex-col justify-content-between">
                        <a href="{{ route('customer.cart.index') }}" class="btn btn-danger">Batal</a>
                        <form action="{{ route('customer.order.store') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">Sudah Bayar</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-secondary" role="alert">
                    <h4 class="alert-heading">Silahkan lakukan pembayaran!</h4>
                    <p><code>Admin</code> akan memvalidasi pembayaran dalam waktu kurang lebih 1-2 menit setelah pemesanan dibuat.</p>
                    <hr>
                    <p class="mb-0">Jika dalam jangka waktu 5 menit, <code>status</code> pesanan anda masih <code>pending</code>, silahkan hubungi <code>Admin</code> untuk meminta bantuan.</p>
                  </div>
            </div>
        </div>
    </div>
@endsection