@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Create User')
@section('content_header_title', 'USERS')
@section('content_header_subtitle', 'Create User')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create User</h3>
        </div>
        <form id="createUserForm" action="{{ route('users.store') }}" method="POST">
            @csrf <!-- This is required to prevent CSRF attacks -->
            <div class="card-body">
                <x-adminlte-input name="name" label="Name" placeholder="User Name"/>
                <x-adminlte-input name="email" type="email" label="Email" placeholder="User Email"/>
                <x-adminlte-select name="role_id" label="Role">
                    <x-adminlte-options :options="$roles"
                        placeholder="Select User Role"/>
                </x-adminlte-select-bs>
            </div>
            <div class="card-footer">
                <x-adminlte-button type="submit" label="Create User" theme="primary"/>
            </div>
        </form>
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
$(function() {
	$('#createUserForm').validate({
		rules: {
            name: {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true,
			},
			role_id: {
				required: true
			},
		},
		messages: {
			name: {
				required: "Please provide a name",
				minlength: "Name must be at least 5 characters long"
			},
			email: {
				required: "Please enter a email address",
				email: "Please enter a valid email address"
			},
			role_id: "Please select role"
		},
		errorElement: 'span',
		errorPlacement: function(error, element) {
			error.addClass('invalid-feedback');
			element.closest('.form-group').append(error);
		},
		highlight: function(element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
});
@endpush