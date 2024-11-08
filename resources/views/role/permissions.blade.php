<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Permissions</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					Permissions
                </li>
            </ol>
        </div>
    </x-slot>

	<!--begin::Form-->
	<form id="updateRolePermissionsForm" action="{{ route('roles.update.permissions', ['role' => $roleId]) }}" method="POST"> <!--begin::Body-->
		@csrf
		@method('patch')
		<div class="card card-primary card-outline">
			<div class="card-header">
				<div class="row"> <!--begin::Col-->
					<div class="col-4">
						<b>
							<x-input-label for="role_id" value="Select Role to Change Permission" />
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
					<div class="col-5">
						<x-button class="btn-primary" type="submit">
							Update
						</x-button>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					@if ($permissions)
						@php
							$permissionFeature = '';
							$permissionFeatureLinks = '';
							$permissionFeatureTabs = '';
							foreach ($permissions as $permission) {
								if ($permissionFeature !== $permission->feature) {
									if ($permissionFeature !== '') {
										$permissionFeatureTabs .= '</div>';
									}

									$permissionFeatureLinks .= '<a class="nav-link' . ($permissionFeature === '' ? ' active' : '') . '" id="feature-' . $permission->feature . '-tab" data-toggle="pill" href="#feature-' . $permission->feature . '" role="tab" aria-controls="feature-'. $permission->feature . '" aria-selected="true">';
									$permissionFeatureLinks .= $permission->feature;
									$permissionFeatureLinks .= '</a>';

									$permissionFeatureTabs .= '<div class="tab-pane text-left fade show ' . ($permissionFeature === '' ? ' active' : '') . '" id="feature-' . $permission->feature . '" role="tabpanel" aria-labelledby="feature-' . $permission->feature . '-tab">';
								}

								$permissionFeatureTabs .= '<div class="form-check">';
									$permissionFeatureTabs .= '<input class="form-check-input" name="permissions[]" type="checkbox" value="' . $permission->id . '" id="permission-' . $permission->id . '" ' . ($permission->roles_count ? 'checked' : '' ) . '>';
									$permissionFeatureTabs .= '<label class="form-check-label" for="permission-' . $permission->id . '">';
										$permissionFeatureTabs .= $permission->display_name;
									$permissionFeatureTabs .= '</label>';
								$permissionFeatureTabs .= '</div>';
								if ($permissionFeature !== $permission->feature) {
									$permissionFeature = $permission->feature;
								}
							}
							$permissionFeatureTabs .= '</div>';
						@endphp
						<div class="col-5 col-sm-3">
							<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
								{!! $permissionFeatureLinks !!}
							</div>
						</div>
						<div class="col-7 col-sm-9">
							<div class="tab-content" id="vert-tabs-tabContent">
								{!! $permissionFeatureTabs !!}
							</div>
						</div>
					@endif
				</div>
			</div>
			<!-- /.card -->
		</div>
	</form> <!--end::Form-->
	@push('styles')
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/toastr/toastr.min.css') }}">
    @endpush
	@push('scripts')
		<script src="{{ asset('vendor/adminlte/plugins/toastr/toastr.min.js') }}"></script>
        <script>
            @if (session('status') === 'permissions-updated')
				toastr.success('{{ __('Updated.') }}')
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