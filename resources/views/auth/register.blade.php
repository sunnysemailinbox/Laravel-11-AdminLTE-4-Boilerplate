<x-guest-layout page="register-page">
    <div class="register-box">
        <div class="register-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <form action="{{ route('register') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="input-group mb-3">
                        <x-text-input id="name" name="name" type="text" :value="old('name')" placeholder="{{ __('Name') }}" required autofocus autocomplete="name" />
                        <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('name')" />
                        <x-input-error :messages="['Please enter name.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email')" placeholder="{{ __('Email') }}" required autocomplete="username" />
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('email')" />
                        <x-input-error :messages="['Please enter email.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" />
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('password')" />
                        <x-input-error :messages="['Please enter password.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" />
                        <div class="input-group-text"> <span class="bi bi-lock"></span> </div>
                        <x-input-error class="d-block" :messages="$errors->get('password_confirmation')" />
                        <x-input-error :messages="['Please confirm password.']" />
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2">
                                <x-button class="btn-primary" type="submit">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <p class="mb-0"> <a href="{{ route('login') }}" class="text-center">
                    {{ __('Already registered?') }}
                    </a> </p>
            </div> <!-- /.register-card-body -->
        </div>
    </div>
</x-guest-layout>