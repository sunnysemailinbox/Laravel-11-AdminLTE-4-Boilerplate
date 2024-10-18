<x-guest-layout page="login-page">
    <div class="login-box">
        <div class="login-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('login') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus autocomplete="username" />
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('email')" />
                        <x-input-error :messages="['Please enter email.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('password')" />
                        <x-input-error :messages="['Please enter password.']" />
                    </div> <!--begin::Row-->
                    <div class="row">
                        <div class="col-8">
                            <div class="form-check"> 
                                <input name="remember" class="form-check-input" type="checkbox" id="remember_me">
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-4">
                            <div class="d-grid gap-2">
                                <x-button class="btn-primary" type="submit">
                                    {{ __('Log in') }}
                                </x-button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                    @endif
                </p>
                <p class="mb-0"> <a href="{{ route('register') }}" class="text-center">
                    {{ __('Register') }}
                    </a> </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div>
</x-guest-layout>