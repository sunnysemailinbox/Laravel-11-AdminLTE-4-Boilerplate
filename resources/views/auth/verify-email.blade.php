<x-guest-layout page="register-page">
    <div class="register-box">
        <div class="register-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                    <p class="login-box-msg">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </p>
                @if (session('status') == 'verification-link-sent')
                    <p class="login-box-msg">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                @endif                
                <!--begin::Row-->
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('verification.send') }}" method="post">
                            @csrf
                            <x-button class="btn-primary btn-block" type="submit">
                                {{ __('Resend Verification Email') }}
                            </x-button>
                        </form>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <x-button class="btn-link btn-block" type="submit">
                                {{ __('Log Out') }}
                            </x-button>
                        </form>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </div> <!-- /.register-card-body -->
        </div>
    </div>
</x-guest-layout>