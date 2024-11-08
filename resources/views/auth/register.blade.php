<x-guest-layout page="register-page">
    <div class="register-box">
        <div class="register-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form id="registerForm" action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <x-text-input id="name" name="name" type="text" :value="old('name')" placeholder="{{ __('Name') }}" required autofocus autocomplete="name" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('name')" />
                        <x-input-error :messages="['Please enter name.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email')" placeholder="{{ __('Email') }}" required autocomplete="username" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('email')" />
                        <x-input-error :messages="['Please enter email.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required autocomplete="new-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('password')" />
                        <x-input-error :messages="['Please enter password.']" />
                    </div>
                    <div class="input-group mb-3">
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password" />
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('password_confirmation')" />
                        <x-input-error :messages="['Please confirm password.']" />
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <x-button class="btn-primary btn-block" type="submit">
                                {{ __('Register') }}
                            </x-button>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <a href="{{ route('login') }}" class="text-center">
                    {{ __('Already registered?') }}
                </a>
            </div> <!-- /.register-card-body -->
        </div>
    </div>
    @push('scripts')
        <!-- jquery-validation -->
        <script src="{{ asset('vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>
            $(function () {
                $('#registerForm').validate({
                    rules: {
                        name: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        password_confirmation: {
                            equalTo: "#password"
                        }
                    },
                    messages: {
                        name: {
                            required: "Please enter name"
                        },
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a valid email address"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        password_confirmation: {
                            equalTo: "Your passwords must match"
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