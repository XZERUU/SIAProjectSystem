<section>
    <header>
        <h2 class="text-lg font-medium text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-400">
            {{ __("Update your account's profile information, email, and avatar.") }}
        </p>
    </header>

    <!-- Email verification form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile update form -->
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name" name="name" type="text"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-white"
                :value="old('name', auth()->user()->name ?? '')" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" name="email" type="email"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-white"
                :value="old('email', auth()->user()->email ?? '')" required autocomplete="username" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-2 text-sm text-white">
                    <p>
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Avatar Upload -->
        <div>
            <x-input-label for="avatar" :value="__('Avatar')" class="text-white" />
            <x-text-input id="avatar" name="avatar" type="file"
                class="mt-1 block w-full bg-gray-700 border-gray-600 text-white" />
            <x-input-error class="mt-2 text-red-400" :messages="$errors->get('avatar')" />
        </div>

        <!-- Avatar Preview -->
        <div>
            <x-input-label value="Current Avatar" class="text-white" />

            @php
                $avatarPath = auth()->user()?->avatar
                    ? asset('storage/' . auth()->user()->avatar)
                    : asset('images/default-profile.png');
            @endphp

            <img src="{{ $avatarPath }}"
                class="mt-2 w-24 h-24 rounded-full object-cover border border-white"
                alt="Avatar Preview">
        </div>

        <!-- Save button -->
        <div class="flex items-center gap-4">
            <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-gray-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
