<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">View Role</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					View Role
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row"> <!--begin::Col-->
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-4">{{ __('Name') }}</dt>
						<dd class="col-sm-8">{{ $role->name }}</dd>

						<dt class="col-sm-4">Display Name</dt>
						<dd class="col-sm-8">{{ $role->display_name }}</dd>
					</dl>
				</div>
				<div class="card-footer">
					<a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit Role</a>
				</div>
			</div>
		</div> <!--end::Col-->
	</div> <!--end::Row-->
</x-app-layout>