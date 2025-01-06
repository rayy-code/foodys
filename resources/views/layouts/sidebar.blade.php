@extends('layouts.app')

@section('link')
    @yield('link')
@endsection

@section('content')
<div class="container-fluid">
   
    <div class="row">
      <div class="col-md-3 col-lg-2 py-5 px-3">
        <form action="#" method="get">
            <h4 class="text-center">Filter</h4>
            <ul class="nav flex-column justify-content-center">
                {{-- <li class="nav-item">
                    <a class="nav-link active" href="{{ route('user.home') }}"> <i class="bi bi-house"></i> Home</a>
                </li> --}}
                <li class="nav-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Semua
                        </label>
                      </div>
                </li>
                <li class="nav-item">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Makanan
                        </label>
                      </div>
                </li>
            </ul>
        </form>
      </div>
  
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        @yield('main-content')
 
      </main>
    </div>
  </div>
@endsection