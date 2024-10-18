<x-guest-layout page="register-page">
    <div class="register-box">
        <div class="register-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div> <!-- /.register-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </p>
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="social-auth-links text-center mb-3 d-grid gap-2">
                        <p>
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </p>
                    </div>
                @endif                
                <!--begin::Row-->
                <div class="row">
                    <div class="col-8">
                        <form action="{{ route('verification.send') }}" method="post">
                            @csrf
                            <div class="d-grid gap-2">
                                <x-button class="btn-primary" type="submit">
                                    {{ __('Resend Verification Email') }}
                                </x-button>
                            </div>
                        </form>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <div class="d-grid gap-2">
                                <x-button class="btn-link" type="submit">
                                    {{ __('Log Out') }}
                                </x-button>
                            </div>
                        </form>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </div> <!-- /.register-card-body -->
        </div>
    </div>
</x-guest-layout>