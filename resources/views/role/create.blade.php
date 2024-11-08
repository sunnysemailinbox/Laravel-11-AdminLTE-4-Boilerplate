<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Create Role</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					Create Role
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row"> <!--begin::Col-->
		<div class="col-12">
			 <!--begin::Form Validation-->
			<div class="card card-primary card-outline mb-4"><!--begin::Form-->
				<form id="createRoleForm" action="{{ route('roles.store') }}" method="POST"> <!--begin::Body-->
					@csrf
					<div class="card-body"> <!--begin::Row-->
						<div class="col-md-7"> <!--begin::Col-->
							<!--begin::Col-->
							<div class="form-group">
								<x-input-label for="name" :value="__('Name')" />
								<x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name" />
								<x-input-error class="d-block" :messages="$errors->get('name')" />
							</div>
							<!--end::Col-->
							<!--begin::Col-->
							<div class="form-group">
								<x-input-label for="display_name" value="Display Name" />
								<x-text-input id="display_name" name="display_name" type="text" :value="old('display_name')" required autocomplete="username" />
								<x-input-error class="d-block" :messages="$errors->get('display_name')" />
							</div>
							<!--end::Col-->
						</div> <!--end::Row-->
					</div> <!--end::Body--> <!--begin::Footer-->
					<div class="card-footer">
						<x-button class="btn-primary" type="submit">
							Create Role
						</x-button>
					</div> <!--end::Footer-->
				</form> <!--end::Form--> <!--begin::JavaScript-->
			</div> <!--end::Form Validation-->
		</div> <!--end::Col-->
	</div> <!--end::Row-->
	@push('scripts')
		<!-- jquery-validation -->
		<script src="{{ asset('vendor/adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
		<script>
			$(function () {
                $('#createRoleForm').validate({
                    rules: {
						name: {
                            required: true
                        },
                        display_name: {
                            required: true
                        }
                    },
                    messages: {
						name: {
                            required: "Please enter a name"
                        },
                        display_name: {
                            required: "Please enter a display name"
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