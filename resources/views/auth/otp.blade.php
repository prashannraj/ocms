<x-guest-layout>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <!-- otp -->
        <div>
            <x-input-label for="otp" :value="__('Enter OTP')" />

            <x-text-input id="otp" class="block mt-1 w-full"
                            type="text"
                            name="otp"
                            required autofocus maxlength="6" />

            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Verify & Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
