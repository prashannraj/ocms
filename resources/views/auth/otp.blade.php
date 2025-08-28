<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        Please enter the 6-digit OTP sent to your email.
    </div>

    @if ($errors->any())
        <div class="mb-4 font-medium text-sm text-red-600">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <!-- OTP Input -->
        <div>
            <x-input-label for="otp" :value="__('OTP')" />
            <x-text-input id="otp" class="block mt-1 w-full" type="text" name="otp" maxlength="6" minlength="6" required autofocus />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button>
                {{ __('Verify OTP') }}
            </x-primary-button>

            {{-- Resend OTP --}}
            <a href="{{ route('otp.resend') }}" class="text-sm text-gray-600 underline hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                {{ __('Resend OTP') }}
            </a>
        </div>
    </form>
</x-guest-layout>
