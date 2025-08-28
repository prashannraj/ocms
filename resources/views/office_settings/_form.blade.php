@extends('layouts.app')

@section('title', 'Edit Office Settings')

@section('content')
<div class="container">
    <h1>Edit Office Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('office_settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- यदि PATCH method प्रयोग गर्नु भएमा --}}
        {{-- @method('PATCH') --}}

        <!-- App Name -->
        <div class="mb-3">
            <label for="app_name" class="form-label">App Name</label>
            <input type="text" name="app_name" id="app_name" class="form-control"
                   value="{{ old('app_name', $officeSetting->app_name ?? '') }}" required>
            @error('app_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control">{{ old('address', $officeSetting->address ?? '') }}</textarea>
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Contact Phone -->
        <div class="mb-3">
            <label for="contact_phone" class="form-label">Contact Phone</label>
            <input type="text" name="contact_phone" id="contact_phone" class="form-control"
                   value="{{ old('contact_phone', $officeSetting->contact_phone ?? '') }}">
            @error('contact_phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Contact Email -->
        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input type="email" name="contact_email" id="contact_email" class="form-control"
                   value="{{ old('contact_email', $officeSetting->contact_email ?? '') }}">
            @error('contact_email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- App Logo -->
        <div class="mb-3">
            <label for="app_logo" class="form-label">App Logo</label>
            <input type="file" name="app_logo" id="app_logo" class="form-control" accept="image/*">
            @error('app_logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if(!empty($officeSetting->app_logo))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . str_replace('public/', '', $officeSetting->app_logo)) }}"
                         alt="App Logo"
                         style="max-height: 80px;" class="rounded shadow">
                </div>
            @else
                <small class="text-muted">No logo uploaded.</small>
            @endif
        </div>

        <!-- App Favicon -->
        <div class="mb-3">
            <label for="app_favicon" class="form-label">App Favicon</label>
            <input type="file" name="app_favicon" id="app_favicon" class="form-control" accept="image/*">
            @error('app_favicon')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            @if(!empty($officeSetting->app_favicon))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . str_replace('public/', '', $officeSetting->app_favicon)) }}"
                         alt="App Favicon"
                         style="max-height: 32px;" class="rounded shadow">
                </div>
            @else
                <small class="text-muted">No favicon uploaded.</small>
            @endif
        </div>

        <!-- Footer Text -->
        <div class="mb-3">
            <label for="footer_text" class="form-label">Footer Text</label>
            <input type="text" name="footer_text" id="footer_text" class="form-control"
                   value="{{ old('footer_text', $officeSetting->footer_text ?? '') }}">
            @error('footer_text')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Timezone -->
        <div class="mb-3">
            <label for="timezone" class="form-label">Timezone</label>
            <input type="text" name="timezone" id="timezone" class="form-control"
                   value="{{ old('timezone', $officeSetting->timezone ?? '') }}" required>
            @error('timezone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Details -->
        <div class="mb-3">
            <label for="details" class="form-label">Details</label>
            <textarea name="details" id="details" class="form-control">{{ old('details', $officeSetting->details ?? '') }}</textarea>
            @error('details')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
