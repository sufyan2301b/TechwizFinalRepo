<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="assets/images/logo.png" width="70px" class="logo">
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="mt-4">
                <x-label for="role" value="{{ __('Register As?') }}" />
                <div>
                    <select id="role" name="role" class="block mt-1 w-full" required>
                        <option value="">Select a role</option>
                        <option value="customer">Customer</option>
                        <option value="designer">Designer</option>
                    </select>
                </div>
            </div>
            <div id="designerProfile" class="mt-4" style="display: none;">
                <label for="profile">Profile Image</label>
                <input type="file" class="form-control" name="profile" accept="image/*">
            </div>
            <div id="bio" class="mt-4" style="display: none;">
                <label for="profile">Bio</label>
                <input type="text" class="form-control" name="bio">
            </div>
            <div id="portfolio-link" class="mt-4" style="display: none;">
                <label for="profile">Portfolio Link</label>
                <input type="text" class="form-control"  name="link">
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
            <script>
                document.getElementById('role').addEventListener('change', function () {
                    const value = this.value;
                    document.getElementById('designerProfile').style.display = value === 'designer' ? 'block' : 'none';
                    document.getElementById('bio').style.display = value === 'designer' ? 'block' : 'none';
                    document.getElementById('portfolio-link').style.display = value === 'designer' ? 'block' : 'none';
                });
            </script>

        </form>
    </x-authentication-card>
</x-guest-layout>
