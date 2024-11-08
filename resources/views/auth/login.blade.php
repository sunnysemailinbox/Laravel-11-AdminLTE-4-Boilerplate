<x-guest-layout page="login-page">
    <div class="login-box">
        <div class="login-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form id="loginForm" action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus autocomplete="username" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('email')" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('password')" />
                    </div> <!--begin::Row-->
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input name="remember" type="checkbox" id="remember_me">
                                <label for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>
                        </div> <!-- /.col -->
                        <div class="col-4">
                            <x-button class="btn-primary btn-block" type="submit">
                                {{ __('Log in') }}
                            </x-button>
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
    @push('styles')
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @endpush
    @push('scripts')
        <!-- jquery-validation -->
        <script src="{{ asset('vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>
            $(function () {
                $('#loginForm').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a valid email address"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.input-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    }
                });
            });
        </script> <!--end::JavaScript-->
    @endpush
</x-guest-layout>