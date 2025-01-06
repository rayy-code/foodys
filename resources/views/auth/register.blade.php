@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center"><i class="bi bi-person-circle"></i> Register</h2>
                <form action="{{ route('user.register') }}" method="post">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username <small class="text-danger">*</small></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" required id="username" name="name" placeholder="Nielsen A"/>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                        <label for="passwordConfirm" class="form-label">Password Conirmation <small class="text-danger">*</small></label>
                        <input type="password" class="form-control" placeholder="password confirmation" required id="passwordConfirm" name="password_confirmation"/>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-success">Register <i class="bi bi-box-arrow-in-right"></i></button>
                    </div>
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