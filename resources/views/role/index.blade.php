<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Roles</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Roles
                </li>
            </ol>
        </div>
    </x-slot>

    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="roles" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Display Name</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    @if (session('status') === 'role-saved')
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="savedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">{{ __('Saved.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status') === 'role-updated')
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="updatedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">{{ __('Updated.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status') === 'role-deleted' || session('status') === 'role-user-exists')
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="deletedToast" class="toast toast-danger" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">
                                        @if (session('status') === 'role-deleted')
                                            Deleted
                                        @elseif (session('status') === 'role-user-exists')
                                            Cannot delete role because users are assigned to it.
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    <x-modal id="confirmRoleDeletionModal" :show="$errors->roleDeletion->isNotEmpty()" focusable>
                        <form  id="roleDeletionForm" method="post">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Are you sure you want to delete role ?') }}</h1>
                                <x-button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></x-button>
                            </div>
                            <div class="modal-body">
                                {{ __('Once role is deleted, all of its resources and data will be permanently deleted.') }}
                            </div>
                            <div class="modal-footer">
                                <x-button class="btn-secondary" type="button" data-bs-dismiss="modal">
                                    {{ __('Cancel') }}
                                </x-button>
                                <x-button class="btn-danger" type="submit">
                                    Delete Role
                                </x-button>
                            </div>
                        </form>
                    </x-modal>
                </div> <!-- /.card-body -->
            </div>
        </div>
    </div> <!--end::Row-->
    @push('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    @endpush
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script>
            @if (session('status') === 'role-saved')
                const toastEle = document.getElementById("savedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            @if (session('status') === 'role-updated')
                const toastEle = document.getElementById("updatedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            @if (session('status') === 'role-deleted'  || session('status') === 'role-user-exists')
                const toastEle = document.getElementById("deletedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            new DataTable('#roles', {
                ajax: "{{ route('roles.datatables.resources') }}",
                processing: true,
                serverSide: true,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'display_name' },
                    {
                        "data": 'actions', // No data source, we'll create the buttons manually
                        "orderable": false,
                        "render": function (data, type, row) {
                            // Assuming you have a route for editing a role
                            var viewUrl = "{{ route('roles.show', ':id') }}".replace(':id', row.id);
                            var viewLink = '<a href="' + viewUrl + '" class="btn btn-sm btn-secondary">View</a>';
                            var editUrl = "{{ route('roles.edit', ':id') }}".replace(':id', row.id);
                            var editLink = '<a href="' + editUrl + '" class="btn btn-sm btn-primary">Edit</a>';
                            var deleteFunction = "showConfirmRoleDeletionModal(:id)".replace(':id', row.id);
                            var deleteButton = '<a class="btn btn-sm btn-danger" onclick="' + deleteFunction + '">Delete</a>';
                            var permissionsUrl = "{{ route('roles.permissions', ':id') }}".replace(':id', row.id);
                            var permissionsLink = '<a href="' + permissionsUrl + '" class="btn btn-sm btn-success">Permissions</a>';
                            return viewLink + ' ' + editLink + ' ' + deleteButton + ' ' + permissionsLink;
                        }
                    }
                ]
            });

            const roleDeletionFormAction = "{{ route('roles.index') }}";
            const roleDeletionForm = document.getElementById('roleDeletionForm');
            function showConfirmRoleDeletionModal(roleId) {
                roleDeletionForm.action = roleDeletionFormAction + '/' + roleId;
                var myModal = new bootstrap.Modal(document.getElementById('confirmRoleDeletionModal'));
                myModal.show();
            }

            $(function() {
                $('.dt-length').html('<a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>');
            });
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>