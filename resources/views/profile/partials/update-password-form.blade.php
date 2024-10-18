<!--begin::Form Validation-->
<div class="card card-warning card-outline mb-4"> <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">{{ __('Update Password') }}</div>
    </div> <!--end::Header--> <!--begin::Form-->
    <form method="post" action="{{ route('password.update') }}" class="needs-validation" novalidate> <!--begin::Body-->
        @csrf
        @method('put')

        <div class="card-body"> <!--begin::Row-->
            <div class="row g-3"> <!--begin::Col-->
                <div class="col-md-7">
                    <div id="emailHelp" class="form-text">
                        {{ __("Ensure your account is using a long, random password to stay secure.") }}
                    </div>
                </div> <!--end::Col--> 
                <!--begin::Col-->
                <div class="col-md-7">
                    <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                    <x-text-input id="update_password_current_password" name="current_password" type="password" required autocomplete="current-password" />
                    <x-input-error class="d-block" :messages="$errors->updatePassword->get('current_password')" />
                    <x-input-error :messages="['Please enter current password.']" />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-7">
                    <x-input-label for="update_password_password" :value="__('New Password')" />
                    <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" required />
                    <x-input-error class="d-block" :messages="$errors->updatePassword->get('password')" />
                    <x-input-error :messages="['Please enter new password.']" />
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-7">
                    <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required />
                    <x-input-error class="d-block" :messages="$errors->updatePassword->get('password_confirmation')" />
                    <x-input-error :messages="['Please confirm password.']" />
                </div>
                <!--end::Col-->
            </div> <!--end::Row-->
        </div> <!--end::Body--> <!--begin::Footer-->
        <div class="card-footer">
            <x-button class="btn-warning" type="submit">
                {{ __('Save') }}
            </x-button>

            @if (session('status') === 'password-updated')
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="passwordSavedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">{{ __('Saved.') }}</strong>
                        </div>
                    </div>
                </div>
            @endif
        </div> <!--end::Footer-->
    </form> <!--end::Form--> <!--begin::JavaScript-->
</div> <!--end::Form Validation-->