@extends('citadel-template::dash.base')
@section('content')
    <div class="row align-items-center justify-content-center g-0
min-vh-100">
        <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
            <!-- Card -->
            <div class="card smooth-shadow-md">
                <!-- Card body -->
                <div class="card-body p-6">
                    <div class="mb-4">
                        <a href="../index.html"><img src="../assets/images/brand/logo/logo-primary.svg" class="mb-2"
                                alt=""></a>
                        <p class="mb-6">Please enter your user information.</p>
                    </div>
                    <!-- Form -->
                    <form>
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Username or email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="Email address here" required="">
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="**************" required="">
                        </div>
                        <!-- Checkbox -->
                        <div class="d-lg-flex justify-content-between align-items-center
          mb-4">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="rememberme">
                                <label class="form-check-label" for="rememberme">Remember
                                    me</label>
                            </div>

                        </div>
                        <div>
                            {{-- @citadel(Button::make('hello')) --}}
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign
                                    in</button>
                            </div>

                            <div class="d-md-flex justify-content-between mt-4">
                                <div class="mb-2 mb-md-0">
                                    <a href="sign-up.html" class="fs-5">Create An
                                        Account </a>
                                </div>
                                <div>
                                    <a href="forget-password.html" class="text-inherit
                fs-5">Forgot your
                                        password?</a>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
