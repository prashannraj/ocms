<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Office Settings') }}
        </h2>
    </x-slot>
    @if(session('status') === 'office-settings-updated')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">Office settings updated successfully.</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.03a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
        </div>
    @endif

   <form action="{{ route('office_settings.update') }}" method="POST" enctype="multipart/form-data" class="py-12">
        @csrf
        <div>
            <x-label for="app_name" :value="__('Application Name')" />
            <x-input id="app_name" class="block mt-1 w-full" type="text" name="app_name" value="{{ old('app_name', $officeSetting->app_name ?? '') }}" required autofocus />
            @error('app_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="app_logo" :value="__('Application Logo')" />
            <input id="app_logo" class="block mt-1 w-full" type="file" name="app_logo" accept="image/*" />
            @if(isset($officeSetting) && $officeSetting->app_logo)
                <img src="{{ Storage::url($officeSetting->app_logo) }}" alt="App Logo" class="mt-2 h-20">
            @endif
            @error('app_logo')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="app_favicon" :value="__('Application Logo')" />
            <input id="app_favicon" class="block mt-1 w-full" type="file" name="app_favicon" accept="image/*" />
            @if(isset($officeSetting) && $officeSetting->app_favicon)
                <img src="{{ Storage::url($officeSetting->app_favicon) }}" alt="App Logo" class="mt-2 h-20">
            @endif
            @error('app_favicon')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="contact_email" :value="__('Contact Email')" />
            <x-input id="contact_email" class="block mt-1 w-full" type="email" name="contact_email" value="{{ old('contact_email', $officeSetting->contact_email ?? '') }}" required />
            @error('contact_email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="contact_phone" :value="__('Contact Phone')" />
            <x-input id="contact_phone" class="block mt-1 w-full" type="text" name="contact_phone" value="{{ old('contact_phone', $officeSetting->contact_phone ?? '') }}" required />
            @error('contact_phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="address" :value="__('Office Address')" />
            <textarea id="address" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" name="address" required>{{ old('address', $officeSetting->address ?? '') }}</textarea>
            @error('address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="footer_text" :value="__('Footer Text')" />
            <x-input id="footer_text" class="block mt-1 w-full" type="text" name="footer_text" value="{{ old('footer_text', $officeSetting->footer_text ?? '') }}" required />
            @error('footer_text')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="timezone" :value="__('Timezone')" />
            <select id="timezone" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" name="timezone" required>
                @foreach(timezone_identifiers_list() as $timezone)
                    <option value="{{ $timezone }}" {{ (old('timezone', $officeSetting->timezone ?? '') == $timezone) ? 'selected' : '' }}>{{ $timezone }}</option>
                @endforeach
            </select>
            @error('timezone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mt-4">
            <x-label for="details" :value="__('Office Details')" />
            <textarea id="details" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" name="details">{{ old('details', $officeSetting->details ?? '') }}</textarea>
            @error('details')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-button class="ml-4">
                {{ __('Save Settings') }}
            </x-button>
        </div>
    </form>
</x-app-layout>
