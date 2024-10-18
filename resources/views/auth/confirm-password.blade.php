<x-guest-layout page="lockscreen">
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo"> <a href="{{ url('/') }}"><b>{{ config('app.name', 'Laravel') }}</b></a> </div>
        @if (auth()->check())
            <div class="lockscreen-name">{{ auth()->user()->name }}</div>
        @endif
        <div class="lockscreen-item">
            <form class="lockscreen-credentials needs-validation" method="POST" action="{{ route('password.confirm') }}" novalidate>
                @csrf
                <div class="input-group">
                    <x-text-input class="shadow-none" id="password" name="password" type="password" placeholder="{{ __('Password') }}" required autocomplete="current-password" />
                    <div class="input-group-text border-0 bg-transparent px-1">
                        <x-button class="shadow-none" type="submit">
                            <i class="bi bi-box-arrow-right text-body-secondary"></i>
                        </x-button>
                    </div>
                    <x-input-error class="d-block" :messages="$errors->get('password')" />
                    <x-input-error :messages="['Please enter email.']" />
                </div>
            </form>
        </div>
        <div class="help-block text-center">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <div class="lockscreen-footer text-center">
            Copyright © 2014-2024 &nbsp;
            <b>
                <a href="{{ url('/') }}" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ config('app.name', 'Laravel') }}</a>
            </b>
            <br>
            All rights reserved
        </div>
    </div>
</x-guest-layout>