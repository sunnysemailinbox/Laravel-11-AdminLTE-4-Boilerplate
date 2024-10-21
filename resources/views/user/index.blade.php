<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">Users</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
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
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </tfoot>
                    </table>
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
            new DataTable('#users', {
                ajax: "{{ route('users.datatables.resources') }}",
                processing: true,
                serverSide: true,
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'role_display_name' }
                ]
            });
        </script> <!--end::JavaScript-->
    @endpush
</x-app-layout>