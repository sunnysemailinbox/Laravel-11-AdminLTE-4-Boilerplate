<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Edit User</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					Edit User
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row"> <!--begin::Col-->
		<div class="col-12">
			 <!--begin::Form Validation-->
			<div class="card card-primary card-outline mb-4">
				<!--begin::Form-->
				<form id="updateUserForm" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data"> <!--begin::Body-->
					@csrf
					@method('PUT')
					<div class="card-body"> <!--begin::Row-->
						<div class="col-md-7">
							<!--begin::Col-->
							<div class="form-group">
								<x-input-label for="name" :value="__('Name')" />
								<x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
								<x-input-error class="d-block" :messages="$errors->get('name')" />
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="form-group">
								<x-input-label for="email" :value="__('Email')" />
								<x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
								<x-input-error class="d-block" :messages="$errors->get('email')" />
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="form-group">
								<x-input-label for="role_id" value="Role" />
								<x-select-input id="role_id" name="role_id" required>
									@if ($roles)
										@foreach ($roles as $role)
											<option {{ $role->id === old('role_id', $user->role_id) ? "selected" : "" }} value="{{ $role->id }}">{{ $role->display_name }}</option>
										@endforeach
									@endif
								</x-select-input>
								<x-input-error class="d-block" :messages="$errors->get('role_id')" />
							</div>
							<!--begin::Col-->
							<div class="form-group">
								<x-input-label for="avatar" value="Avatar" />
								<div class="input-group">
									<div class="custom-file">
										<x-text-input id="avatar" name="avatar" type="file" class="custom-file-input" />
										<label class="custom-file-label" for="avatar">Choose file</label>
									</div>
								</div>
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
		<!-- bs-custom-file-input -->
		<script src="{{ asset('vendor/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <!-- jquery-validation -->
        <script src="{{ asset('vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
		<script>
			$(function () {
				bsCustomFileInput.init();

                $('#updateUserForm').validate({
                    rules: {
						name: {
                            required: true
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        role_id: {
                            required: true
                        }
                    },
                    messages: {
						name: {
                            required: "Please enter a name"
                        },
                        email: {
                            required: "Please enter a email address",
                            email: "Please enter a valid email address"
                        },
                        role_id: {
                            required: "Please select a role"
                        }
                    },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
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
</x-app-layout>