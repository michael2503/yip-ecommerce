<x-guest-layout>

    <style>
        .form-control{
            font-size: 14px
        }
    </style>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-5">

                <div class="card card-body mt-5 mb-5">
                    <h6 class="text-center mb-4">REGISTER</h6>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger ml-0" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger ml-0" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger ml-0" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="form-control"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger ml-0" />
                        </div>

                        <div class="flex text-center justify-end mt-4">
                            <a class="text-dark" href="{{ route('login') }}">
                                {{ __('Already registered? Login') }}
                            </a>

                            <x-primary-button class="ms-3 mt-4 btn btn-primary btn-block">
                                {{ __('Register') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

</x-guest-layout>
