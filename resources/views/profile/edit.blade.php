<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Profile') }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('Profile') }}
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row g-4"> <!--begin::Col-->
        <div class="col-12">
            @include('profile.partials.update-profile-information-form')
            @include('profile.partials.update-password-form')
            @include('profile.partials.delete-user-form')
        </div> <!--end::Col--> <!--begin::Col-->
    </div> <!--end::Row-->
    @push('scripts')
        <script>
            @if (session('status') === 'profile-updated')
                const toastEle = document.getElementById("savedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            @if (session('status') === 'password-updated')
                const toastEle = document.getElementById("passwordSavedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (() => {
                "use strict";

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms =
                    document.querySelectorAll(".needs-validation");

                // Loop over them and prevent submission
                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        "submit",
                        (event) => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add("was-validated");
                        },
                        false
                    );
                });

                @if ($errors->userDeletion->get('password'))
                    var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                    myModal.show();
                @endif
            })();
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>