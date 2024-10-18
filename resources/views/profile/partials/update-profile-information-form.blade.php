<!--begin::Form Validation-->
<div class="card card-success card-outline mb-4"> <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">{{ __('Profile Information') }}</div>
    </div> <!--end::Header--> <!--begin::Form-->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="needs-validation" novalidate> <!--begin::Body-->
        @csrf
        @method('patch')
        <div class="card-body"> <!--begin::Row-->
            <div class="row g-3"> <!--begin::Col-->
                <div class="col-md-7">
                    <div id="emailHelp" class="form-text">
                        {{ __("Update your account's profile information and email address.") }}
                    </div>
                </div> <!--end::Col--> 
                <!--begin::Col-->
                <div class="col-md-7">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="d-block" :messages="$errors->get('name')" />
                    <x-input-error :messages="['Please enter name.']" />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-7">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="d-block" :messages="$errors->get('email')" />
                    <x-input-error :messages="['Please enter email.']" />
                </div>
                <!--end::Col-->
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="col-md-7">
                        <x-input-label :value="__('Your email address is unverified.')" />
                        <x-button class="btn-link" form="send-verification" type="button">
                            {{ __('Click here to re-send the verification email.') }}
                        </x-button>

                        @if (session('status') === 'verification-link-sent')
                            <x-input-error class="d-block" :messages="[__('A new verification link has been sent to your email address.')]" />
                        @endif
                    </div>
                @endif
            </div> <!--end::Row-->
        </div> <!--end::Body--> <!--begin::Footer-->
        <div class="card-footer">
            <x-button class="btn-success" type="submit">
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'profile-updated')
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="savedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">{{ __('Saved.') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
        </div> <!--end::Footer-->
    </form> <!--end::Form--> <!--begin::JavaScript-->
</div> <!--end::Form Validation-->