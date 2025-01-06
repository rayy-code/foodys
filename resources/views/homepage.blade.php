@extends('layouts.app')

@section('link')
    


@section('content')
    <div class="container-xxl py-4">
        @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil! </strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endsession  
        <div class="mb-3 row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body align-items-center d-flex flex-column">
                        <h1 class="text-success fw-bold mb-0">Foodys</h1>
                        <p class="text-secondary">Taste your special moments with special food</p>
                        <div class="w-50 mt-3">
                            <form action="{{ route('user.menu.search') }}" class="d-flex flex-row" method="get" role="search">
                                <input type="text" name="q" class="form-control mx-1" value="{{ isset($key) ? $key : '' }}" placeholder="Search food"/>
                                <button type="submit" class="btn btn-success mx-1"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($key)
            <div class="mb-3">
                <h2>Hasil pencarian <span class="text-success">{{ $key }}</span></h2>
            </div>
        @endisset
        <div class="d-flex justify-content-start flex-wrap align-items-center pt-3 pb-2 mb-3">
            @foreach ($foods as $item)
                <div class="card m-2" style="max-width:16rem; height: 22rem;">
                    <img src="{{ asset('storage/public/images/menu/'.$item->image) }}" style="max-width: inherit;" alt="">
                    <div class="card-body" >
                        <h5 class="card-title mb-0">{{ $item->name }}</h5>
                        <p class="card-text">Rp. {{ $item->price }}</p>
                        <span class="text-secondary">
                            {{ $item->description }}
                        </span>
                        @auth
                            <a href="{{ route('customer.menu.show',$item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-info-circle"></i> Detail</a>
                        @else
                        <a href="{{ route('user.login') }}" class="btn btn-success">Login</a>
                        @endauth
                       
                    </div>
                </div>
            @endforeach
        </div> 
        <div class="my-2">
            {{ $foods->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection