<!--begin::Form Validation-->
<div class="card card-danger card-outline mb-4"> <!--begin::Header-->
    <div class="card-header">
        <div class="card-title">{{ __('Delete Account') }}</div>
    </div> <!--end::Header--> <!--begin::Form-->
    <div class="card-body"> <!--begin::Row-->
        <div class="row g-3"> <!--begin::Col-->
            <div class="col-md-7">
                <div id="emailHelp" class="form-text">
                    {{ __("Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.") }}
                </div>
            </div> <!--end::Col--> 
        </div> <!--end::Row-->
    </div> <!--end::Body--> <!--begin::Footer-->
    <div class="card-footer">
        <x-button class="btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
            {{ __('Delete Account') }}
        </x-button>
        <x-modal id="confirmUserDeletionModal" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="needs-validation" novalidate>
                @csrf
                @method('delete')

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Are you sure you want to delete your account?') }}</h1>
                    <x-button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></x-button>
                </div>
                <div class="modal-body">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    <div class="col-md-7">
                        <x-input-label for="password" :value="__('Password')" class="sr-only" />
                        <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" required />
                        <x-input-error class="d-block" :messages="$errors->userDeletion->get('password')" />
                        <x-input-error :messages="['Please enter password.']" />
                    </div>
                </div>
                <div class="modal-footer">
                    <x-button class="btn-secondary" type="button" data-bs-dismiss="modal">
                        {{ __('Cancel') }}
                    </x-button>
                    <x-button class="btn-danger" type="submit">
                        {{ __('Delete Account') }}
                    </x-button>
                </div>
            </form>
        </x-modal>
    </div> <!--end::Footer-->
</div> <!--end::Form Validation-->