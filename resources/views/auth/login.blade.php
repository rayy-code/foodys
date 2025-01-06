@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h2 class="text-center"><i class="bi bi-person-circle"></i> Login</h2>
            @session('success')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil! </strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            @session('error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal! </strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endsession
            <form method="POST" action="{{ route('user.login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email <small class="text-danger">*</small></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" required id="email" name="email" placeholder="example@example.com"/>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password <small class="text-danger">*</small></label>
                    <div class="input-group">
                        <input type="password" required placeholder="password" class="form-control @error('password') is-invalid @enderror" aria-label="password" aria-describedby="btn-show" required id="password" name="password"/>
                        <button class="btn btn-outline-secondary" title="show password" type="button" id="btn-show"><i id="icon-show-password" class="bi bi-eye"></i></button>
                    </div>
                    <small class="text-secondary">min 8 digit</small>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
               
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Login <i class="bi bi-box-arrow-in-right"></i></button>
                </div>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif

                
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('btn-show').addEventListener('click', function(){
        var x = document.getElementById('password');
        var y = document.getElementById('icon-show-password');
        if(x.type === "password"){
            x.type = "text";
            y.classList.remove('bi-eye');
            y.classList.add('bi-eye-slash');
        }else{
            x.type = "password";
            y.classList.remove('bi-eye-slash');
            y.classList.add('bi-eye');
        }
    })
</script>
@endsection
