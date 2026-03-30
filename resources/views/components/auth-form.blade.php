@props(['type' => 'login'])

<div class='login-auth-page min-vh-100'>
    <div class="container-fluid auth-container">
        <div class="row min-vh-100 m-0 d-flex align-items-center justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4 d-flex flex-column align-items-center py-5">

                {{-- Header / Logo --}}
                <div class='auth-right d-flex align-items-center justify-content-center mb-4'>
                    <div class='logo me-3'>
                        <img src="{{ asset('images/logo.png') }}" alt="The Journal Logo" class="header-logo-img" />
                    </div>
                    <h1 class='auth-title-header m-0'>The Journal</h1>
                </div>

                {{-- Form Panel --}}
                <div class="auth-content-wrapper auth-form-panel">
                    <form method="POST" action="{{ $type === 'signup' ? route('signup') : route('login') }}" class="auth-form">
                        @csrf

                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h2 class="auth-header mb-1">
                                {{ $type === 'login' ? 'Welcome back!' : 'Create an account' }}
                            </h2>
                            <p class="auth-subtitle mb-4">
                                {{ $type === 'login' ? "Let's get you signed in." : '' }}
                            </p>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger py-2" role="alert">
                                <small>{{ session('error') }}</small>
                            </div>
                        @endif

                        @if($type === 'signup')
                            <div class='form-group mb-3'>
                                <input type='text' name='username' class="form-control @error('username') is-invalid @enderror" placeholder='Username' value="{{ old('username') }}" required autofocus />
                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        @endif

                        <div class='form-group mb-3'>
                            <input type='email' name='email' class="form-control @error('email') is-invalid @enderror" placeholder='Email' value="{{ old('email') }}" required {{ $type === 'login' ? 'autofocus' : '' }} />
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class='form-group mb-3'>
                            <input type='password' name='password' class="form-control @error('password') is-invalid @enderror" placeholder='Password' required />
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        @if($type === 'signup')
                            <div class='form-group mb-3'>
                                <input type='password' name='password_confirmation' class="form-control" placeholder='Confirm Password' required />
                            </div>
                        @endif

                        @if($type === 'login')
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-muted" for="remember">
                                        <small>Remember me</small>
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-psd text-decoration-none">
                                        <small>Forgot password?</small>
                                    </a>
                                @endif
                            </div>
                        @endif

                        <button type='submit' class="btn btn-primary w-100 mt-3 py-2 auth-btn">
                            {{ $type === 'login' ? 'Log in' : 'Sign up' }}
                        </button>

                        <div class='text-center mt-4'>
                            <span class="text-muted">
                                {{ $type === 'signup' ? 'Already have an account?' : "Don't have an account?" }}
                            </span>
                            <a href="{{ $type === 'signup' ? route('login') : route('signup') }}" class='auth-link text-decoration-none ms-1'>
                                {{ $type === 'signup' ? 'Log in' : 'Sign up' }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
