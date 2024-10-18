<x-app-layout>
    <x-slot name="header">
        <div class="col-sm-6">
            <h3 class="mb-0">{{ __('Dashboard') }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ __('Dashboard') }}
                </li>
            </ol>
        </div>
    </x-slot>

    <div class="row g-4"> <!--begin::Col-->
        <div class="col-12">
            <div class="callout callout-info">
                {{ __("You're logged in!") }}
            </div>
        </div> <!--end::Col--> <!--begin::Col-->
    </div> <!--end::Row-->
</x-app-layout>
