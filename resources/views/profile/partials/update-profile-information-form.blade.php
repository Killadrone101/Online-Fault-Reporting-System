<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            @if(Auth::user()->role === 'student')
                {{ __("Your profile information is managed by the system administrator.") }}
            @else
                {{ __("Update your account's profile information and email address.") }}
            @endif
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            @if(Auth::user()->role === 'student')
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->name" readonly disabled />
            @else
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            @endif
        </div>

        @if(Auth::user()->role === 'student')
            {{-- Students cannot update their details - display read-only fields --}}
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" class="mt-1 block w-full bg-gray-100" :value="$user->email" readonly disabled />
            </div>
            <div>
                <x-input-label for="student_id" :value="__('Student ID')" />
                <x-text-input id="student_id" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->student_id ?? 'Not specified'" readonly disabled />
            </div>
            <div>
                <x-input-label for="residence" :value="__('Residence')" />
                <x-text-input id="residence" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->residence ?? 'Not specified'" readonly disabled />
            </div>
            <p class="text-sm text-gray-600 italic mt-4">
                {{ __("Contact administration if you need to update your profile information.") }}
            </p>
        @else
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            @if(Auth::user()->role !== 'student')
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600"
                    >{{ __('Saved.') }}</p>
                @endif
            @endif
        </div>
    </form>
</section>
