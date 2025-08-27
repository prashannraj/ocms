<form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text"
               class="form-control"
               id="name"
               name="name"
               value="{{ old('name', $user->name) }}"
               required autofocus autocomplete="name">
        @error('name')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email"
               class="form-control"
               id="email"
               name="email"
               value="{{ old('email', $user->email) }}"
               required autocomplete="username">
        @error('email')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-warning small mb-1">
                    Your email address is unverified.
                    <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">
                        Click here to re-send the verification email.
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="text-success small mb-0">
                        A new verification link has been sent to your email address.
                    </p>
                @endif
            </div>
        @endif
    </div>

    <!-- ✅ Profile Image Upload -->
    <div class="mb-3">
        <label for="profile_image" class="form-label">Profile Image</label>
        <input type="file"
               class="form-control"
               id="profile_image"
               name="profile_image"
               accept="image/*">
        @error('profile_image')
            <div class="text-danger mt-1">{{ $message }}</div>
        @enderror

        {{-- पुरानो प्रोफाइल फोटो देखाउने (यदि छ भने) --}}
        @if ($user->profile_image)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Current Profile" width="80" class="rounded">
            </div>
        @endif
    </div>

    <!-- Save Button -->
    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">Save</button>
        @if (session('status') === 'profile-updated')
            <small class="text-success">Saved.</small>
        @endif
    </div>
</form>
