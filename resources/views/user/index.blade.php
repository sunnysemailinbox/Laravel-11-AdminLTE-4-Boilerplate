<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Users</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Users
                </li>
            </ol>
        </div>
    </x-slot>

    <!--begin::Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="users" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>

                    <x-modal id="confirmUserDeletionModal" :show="$errors->userDeletion->isNotEmpty()">
                        <form  id="userDeletionForm" method="post">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">{{ __('Are you sure you want to delete user ?') }}</h4>
                                <x-button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </x-button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    {{ __('Once user is deleted, all of its resources and data will be permanently deleted.') }}
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <x-button class="btn btn-secondary" type="button" data-dismiss="modal">
                                    {{ __('Cancel') }}
                                </x-button>
                                <x-button class="btn btn-danger" type="submit">
                                    {{ __('Delete User') }}
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
        <script src="{{ asset('vendor/adminlte/plugins/toastr/toastr.min.js') }}"></script>
        <script>
            @if (session('status') === 'user-saved')
                toastr.success('{{ __('Saved.') }}')
            @endif

            @if (session('status') === 'user-updated')
                toastr.success('{{ __('Updated.') }}')
            @endif

            @if (session('status') === 'user-deleted')
                toastr.error('Deleted.')
            @endif

            new DataTable('#users', {
                ajax: "{{ route('users.datatables.resources') }}",
                processing: true,
                serverSide: true,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'role_display_name' },
                    {
                        "data": 'actions', // No data source, we'll create the buttons manually
                        "orderable": false,
                        "render": function (data, type, row) {
                            // Assuming you have a route for editing a user
                            var viewUrl = "{{ route('users.show', ':id') }}".replace(':id', row.id);
                            var viewLink = '<a href="' + viewUrl + '" class="btn btn-sm btn-secondary">View</a>';
                            var editUrl = "{{ route('users.edit', ':id') }}".replace(':id', row.id);
                            var editLink = '<a href="' + editUrl + '" class="btn btn-sm btn-primary">Edit</a>';
                            var deleteFunction = "showConfirmUserDeletionModal(:id)".replace(':id', row.id);
                            var deleteButton = '<a class="btn btn-sm btn-danger" onclick="' + deleteFunction + '">Delete</a>';
                            return viewLink + ' ' + editLink + ' ' + deleteButton;
                        }
                    }
                ]
            });

            const userDeletionFormAction = "{{ route('users.index') }}";
            const userDeletionForm = document.getElementById('userDeletionForm');
            function showConfirmUserDeletionModal(userId) {
                userDeletionForm.action = userDeletionFormAction + '/' + userId;
                var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'));
                myModal.show();
            }

            $(function() {
                $('.dataTables_length').html('<a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>');
            });
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>