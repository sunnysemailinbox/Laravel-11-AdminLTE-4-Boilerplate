<x-guest-layout page="login-page">
    <div class="login-box">
        <div class="login-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
                <form action="{{ route('password.email') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('email')" />
                        <x-input-error :messages="['Please enter email.']" />
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <x-button class="btn-primary" type="submit">
                                    {{ __('Email Password Reset Link') }}
                                </x-button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <p class="mb-1">
                    <a href="{{ route('login') }}">{{ __('Log in') }}</a>
                </p>
                <p class="mb-0"> <a href="{{ route('register') }}" class="text-center">
                        {{ __('Register') }}
                    </a> </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div>
</x-guest-layout>