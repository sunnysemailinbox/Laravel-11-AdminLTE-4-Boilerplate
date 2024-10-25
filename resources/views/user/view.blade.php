<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">View User</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
					View User
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row g-4"> <!--begin::Col-->
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<dl class="row">
						<dt class="col-sm-4">{{ __('Name') }}</dt>
						<dd class="col-sm-8">{{ $user->name }}</dd>

						<dt class="col-sm-4">{{ __('Email') }}</dt>
						<dd class="col-sm-8">{{ $user->email }}</dd>

						<dt class="col-sm-4">Role</dt>
						<dd class="col-sm-8">{{ $user->role->display_name }}</dd>
					</dl>
				</div>
				<div class="card-footer">
					<a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit User</a>
				</div>
			</div>
		</div> <!--end::Col-->
	</div> <!--end::Row-->
</x-app-layout>