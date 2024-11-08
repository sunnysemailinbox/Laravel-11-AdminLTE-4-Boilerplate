<x-guest-layout page="lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div>
        @if (auth()->check())
            <div class="lockscreen-name">{{ auth()->user()->name }}</div>
        @endif
        <div class="lockscreen-item">
            @if (auth()->check())
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                    <img src="{{ Auth::user()->avatar_url }}" alt="User Image">
                </div>
                <!-- /.lockscreen-image -->
            @endif
            <form id="confirmPasswordForm" class="lockscreen-credentials" method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="input-group">
                    <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                    <div class="input-group-append">
                        <x-button type="submit">
                            <i class="fas fa-arrow-right text-muted"></i>
                        </x-button>
                    </div>
                    <x-input-error class="d-block" :messages="$errors->get('password')" />
                    <x-input-error :messages="['Please enter email.']" />
                </div>
            </form>
        </div>
        <div class="help-block text-center">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <div class="lockscreen-footer text-center">
            Copyright © 2014-2024 &nbsp;
            <b>
                <a href="{{ url('/dashboard') }}" class="text-black">{{ config('app.name', 'Laravel') }}</a>
            </b>
            <br>
            All rights reserved
        </div>
    </div>
    @push('scripts')
        <!-- jquery-validation -->
        <script src="{{ asset('vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script>
            $(function () {
                $('#confirmPasswordForm').validate({
                    rules: {
                        password: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
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