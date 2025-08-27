<form action="{{ isset($officeSetting) ? route('office_settings.update') : '#' }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($officeSetting))
        {{-- Since update is POST route --}}
    @endif

    <div class="mb-3">
        <label for="app_name" class="form-label">App Name</label>
        <input type="text" name="app_name" id="app_name" class="form-control" value="{{ old('app_name', $officeSetting->app_name ?? '') }}" required>
        @error('app_name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea name="address" id="address" class="form-control">{{ old('address', $officeSetting->address ?? '') }}</textarea>
        @error('address')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="contact_phone" class="form-label">Contact Phone</label>
        <input type="text" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone', $officeSetting->contact_phone ?? '') }}">
        @error('contact_phone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="contact_email" class="form-label">Contact Email</label>
        <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email', $officeSetting->contact_email ?? '') }}">
        @error('contact_email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="app_logo" class="form-label">App Logo</label>
        <input type="file" name="app_logo" id="app_logo" class="form-control">
        @error('app_logo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if(!empty($officeSetting->app_logo))
            <img src="{{ Storage::url($officeSetting->app_logo) }}" alt="App Logo" width="80" class="mt-2">
        @endif
    </div>

    <div class="mb-3">
        <label for="app_favicon" class="form-label">App Favicon</label>
        <input type="file" name="app_favicon" id="app_favicon" class="form-control">
        @error('app_favicon')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if(!empty($officeSetting->app_favicon))
            <img src="{{ Storage::url($officeSetting->app_favicon) }}" alt="App Favicon" width="32" class="mt-2">
        @endif
    </div>

    <div class="mb-3">
        <label for="footer_text" class="form-label">Footer Text</label>
        <input type="text" name="footer_text" id="footer_text" class="form-control" value="{{ old('footer_text', $officeSetting->footer_text ?? '') }}">
        @error('footer_text')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="timezone" class="form-label">Timezone</label>
        <input type="text" name="timezone" id="timezone" class="form-control" value="{{ old('timezone', $officeSetting->timezone ?? '') }}" required>
        @error('timezone')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label for="details" class="form-label">Details</label>
        <textarea name="details" id="details" class="form-control">{{ old('details', $officeSetting->details ?? '') }}</textarea>
        @error('details')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save Settings</button>
</form>
