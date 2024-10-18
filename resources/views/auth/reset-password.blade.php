<x-guest-layout page="register-page">
    <div class="register-box">
        <div class="register-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Password Reset</p>
                <form action="{{ route('password.store') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email', $request->email)" placeholder="{{ __('Email') }}" required autofocus autocomplete="username" />
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
                                    {{ __('Reset Password') }}
                                </x-button>
                            </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
            </div> <!-- /.register-card-body -->
        </div>
    </div>
</x-guest-layout>