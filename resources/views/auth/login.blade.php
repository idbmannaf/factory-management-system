@extends('layouts.app')
   @section('content')

    @include('alerts.alerts')

        {{--
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form> --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 m-auto">
                        <div class="featured-box featured-box-primary text-left mt-2">
                            <div class="box-content" style="height: 80vh">
                                <h4 class="color-primary font-weight-semibold text-8 text-uppercase mb-3">Login</h4>
                                <div>
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                </div>
                                <form  action="{{ route('login') }}" id="frmSignIn" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label class="font-weight-bold text-dark text-2">Mobile Number</label>
                                            <input type="text" value="" name="mobile" class="form-control form-control-lg">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            @if (Route::has('password.request'))
                                            <a class="float-right" href="{{ route('password.request') }}">(Lost Password?)</a>
                                            @endif
                                            <label class="font-weight-bold text-dark text-2">Password</label>
                                            <input type="password" value="" class="form-control form-control-lg" id="password" name="password" required  autocomplete="current-password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                                                <label class="custom-control-label text-2" for="remember_me">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input type="submit" value="Login" class="btn btn-primary- w3-orange float-right" data-loading-text="Loading...">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


