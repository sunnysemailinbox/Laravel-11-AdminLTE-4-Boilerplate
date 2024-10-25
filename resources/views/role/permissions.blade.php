<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Permissions</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					Permissions
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row g-4"> <!--begin::Col-->
		<div class="col-12">
			<div class="card card-primary card-outline mb-4">
				<!--begin::Form-->
				<form id="updateRolePermissionsForm" action="{{ route('roles.update.permissions', ['role' => $roleId]) }}" method="POST"> <!--begin::Body-->
					@csrf
					@method('patch')
					<div class="card-header">
						<div class="row g-4"> <!--begin::Col-->
							<div class="col-3">
								<b>
									<x-input-label for="role_id" value="Select Role to change permission" />
								</b>
							</div>
							<div class="col-3">
								<x-select-input id="role_id" required onchange="loadURL(this)">
									@if ($roles)
										<option selected="" disabled="" value="">Select Role</option>
										@foreach ($roles as $role)
											<option {{ $role->id == $roleId ? "selected" : "" }} value="{{ $role->id }}">{{ $role->display_name }}</option>
										@endforeach
									@endif
								</x-select-input>
							</div>
							<div class="col-6">
								<x-button class="btn-primary" type="submit">
									Update
								</x-button>
							</div>
						</div>
					</div>
					<!--begin::Body-->
					<div class="card-body">
						<div class="row g-4"> <!--begin::Col-->
							<div class="col-12">
								<div class="accordion" id="accordionExample">
									@if ($permissions)
										@php
											$permissionFeature = '';
										@endphp
										@foreach ($permissions as $permission)
											@if ($permissionFeature !== $permission->feature)
												@if ($permissionFeature !== '')
																</div> <!--end::Row-->
															</div>
														</div>
													</div>
												@endif
												<div class="accordion-item">
													<h2 class="accordion-header">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#feature-{{ $permission->feature }}" aria-expanded="true" aria-controls="feature-{{ $permission->feature }}">
															{{ $permission->feature }}
														</button>
													</h2>
													<div id="feature-{{ $permission->feature }}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
														<div class="accordion-body">
															<div class="row g-3">
											@endif
																<div class="col-12">
																	<div class="form-check">
																		<input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $permission->id }}" id="permission-{{ $permission->id }}" {{ $permission->roles_count ? 'checked' : '' }}>
																		<label class="form-check-label" for="permission-{{ $permission->id }}">
																			{{ $permission->display_name }}
																		</label>
																	</div>
																</div> <!--end::Col-->
											@php
												if ($permissionFeature !== $permission->feature) {
													$permissionFeature = $permission->feature;
												}
											@endphp
										@endforeach
													</div> <!--end::Row-->
												</div>
											</div>
										</div>
									@endif
								</div>
							</div> <!--end::Col-->
						</div> <!--end::Row-->
					</div> <!--end::Body-->
				</form> <!--end::Form-->
				@if (session('status') === 'permissions-updated')
					<div class="toast-container position-fixed bottom-0 end-0 p-3">
						<div id="updatedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
							<div class="toast-header">
								<strong class="me-auto">{{ __('Updated.') }}</strong>
							</div>
						</div>
					</div>
				@endif
			</div> <!--end::Accordion-->
		</div> <!--end::Col-->
	</div> <!--end::Row-->
	@push('scripts')
        <script>
            @if (session('status') === 'permissions-updated')
                const toastEle = document.getElementById("updatedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

			function loadURL(selectElement) {
				var selectedValue = selectElement.value;
				if (selectedValue) {
					var permissionsUrl = "{{ route('roles.permissions', ':id') }}".replace(':id', selectedValue);
					window.location.href = permissionsUrl; // Redirect to the selected URL
				}
			}
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>