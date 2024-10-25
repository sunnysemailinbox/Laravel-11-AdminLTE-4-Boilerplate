<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit User</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					Edit User
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row g-4"> <!--begin::Col-->
		<div class="col-12">
			 <!--begin::Form Validation-->
			<div class="card card-primary card-outline mb-4">
				<!--begin::Form-->
				<form id="createUserForm" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data"> <!--begin::Body-->
					@csrf
					@method('PUT')
					<div class="card-body"> <!--begin::Row-->
						<div class="row g-3"> <!--begin::Col-->
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
							<!--begin::Col-->
							<div class="col-md-7">
								<x-input-label for="role_id" value="Role" />
								<x-select-input id="role_id" name="role_id" required>
									@if ($roles)
										@foreach ($roles as $role)
											<option {{ $role->id === old('role_id', $user->role_id) ? "selected" : "" }} value="{{ $role->id }}">{{ $role->display_name }}</option>
										@endforeach
									@endif
								</x-select-input>
								<x-input-error class="d-block" :messages="$errors->get('role_id')" />
								<x-input-error :messages="['Please select role.']" />
							</div>
							<!--begin::Col-->
							<div class="col-md-7">
								<x-input-label for="avatar" value="Avatar" />
								<x-text-input id="avatar" name="avatar" type="file" />
								<x-input-error class="d-block" :messages="$errors->get('avatar')" />
							</div>
							<!--end::Col-->
						</div> <!--end::Row-->
					</div> <!--end::Body--> <!--begin::Footer-->
					<div class="card-footer">
						<x-button class="btn-primary" type="submit">
							Update User
						</x-button>
					</div> <!--end::Footer-->
				</form> <!--end::Form--> <!--begin::JavaScript-->
			</div> <!--end::Form Validation-->
		</div> <!--end::Col-->
	</div> <!--end::Row-->
	@push('scripts')
		<script>
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
			})();
		</script> <!--end::JavaScript-->
    @endpush
</x-app-layout>