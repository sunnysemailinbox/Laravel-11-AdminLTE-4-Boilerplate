<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Roles</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
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

                    <x-modal id="confirmRoleDeletionModal" :show="$errors->roleDeletion->isNotEmpty()">
                        <form  id="roleDeletionForm" method="post">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">{{ __('Are you sure you want to delete role ?') }}</h4>
                                <x-button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </x-button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    {{ __('Once role is deleted, all of its resources and data will be permanently deleted.') }}
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <x-button class="btn-secondary" type="button" data-dismiss="modal">
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
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/toastr/toastr.min.css') }}">
    @endpush
    @push('scripts')
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('vendor/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('vendor/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script>
            @if (session('status') === 'role-saved')
                toastr.success('{{ __('Saved.') }}')
            @endif

            @if (session('status') === 'role-updated')
                toastr.success('{{ __('Updated.') }}')
            @endif

            @if (session('status') === 'role-deleted'  || session('status') === 'role-user-exists')
                @php
                    $message = '';

                    if(session('status') === 'role-deleted') {
                        $message = 'Deleted';
                    }
                    else if (session('status') === 'role-user-exists') {
                        $message = 'Cannot delete role because users are assigned to it.';
                    }
                @endphp

                toastr.error('{{ $message }}')
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
                $('.dataTables_length').html('<a href="{{ route('roles.create') }}" class="btn btn-primary">Create Role</a>');
            });
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>