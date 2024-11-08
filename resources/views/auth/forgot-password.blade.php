<x-guest-layout page="login-page">
    <div class="login-box">
        <div class="login-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
                <form id="forgotPassword" action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <x-text-input id="email" name="email" type="email" :value="old('email')" placeholder="{{ __('Email') }}" required autofocus />
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <x-input-error class="d-block" :messages="$errors->get('email')" />
                        <x-input-error :messages="['Please enter email.']" />
                    </div>
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <x-button class="btn-primary btn-block" type="submit">
                                {{ __('Email Password Reset Link') }}
                            </x-button>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">{{ __('Log in') }}</a>
                </p>
                <p class="mb-0"> <a href="{{ route('register') }}" class="text-center">
                        {{ __('Register') }}
                    </a> </p>
            </div> <!-- /.login-card-body -->
        </div>
    </div>
    @push('scripts')
        <!-- jquery-validation -->
        <script src="{{ asset('vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>
            $(function () {
                $('#forgotPassword').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true,
                        }
                    },
                    messages: {
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a valid email address"
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