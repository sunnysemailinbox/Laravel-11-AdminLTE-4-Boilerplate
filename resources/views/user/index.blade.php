<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Users</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
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
                    @if (session('status') === 'user-saved')
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="savedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">{{ __('Saved.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status') === 'user-updated')
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="updatedToast" class="toast toast-success" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">{{ __('Updated.') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('status') === 'user-deleted')
                        <div class="toast-container position-fixed bottom-0 end-0 p-3">
                            <div id="deletedToast" class="toast toast-danger" role="alert" aria-live="assertive" aria-atomic="true">
                                <div class="toast-header">
                                    <strong class="me-auto">Deleted</strong>
                                </div>
                            </div>
                        </div>
                    @endif

                    <x-modal id="confirmUserDeletionModal" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form  id="userDeletionForm" method="post">
                            @csrf
                            @method('delete')

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Are you sure you want to delete user ?') }}</h1>
                                <x-button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></x-button>
                            </div>
                            <div class="modal-body">
                                {{ __('Once user is deleted, all of its resources and data will be permanently deleted.') }}
                            </div>
                            <div class="modal-footer">
                                <x-button class="btn-secondary" type="button" data-bs-dismiss="modal">
                                    {{ __('Cancel') }}
                                </x-button>
                                <x-button class="btn-danger" type="submit">
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
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    @endpush
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <script>
            @if (session('status') === 'user-saved')
                const toastEle = document.getElementById("savedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            @if (session('status') === 'user-updated')
                const toastEle = document.getElementById("updatedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
            @endif

            @if (session('status') === 'user-deleted')
                const toastEle = document.getElementById("deletedToast");
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEle);
                toastBootstrap.show();
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
                $('.dt-length').html('<a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>');
            });
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>