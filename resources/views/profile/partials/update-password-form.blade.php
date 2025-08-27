<div class="mb-4">
    <h4 class="mb-2">Update Password</h4>
    <p class="text-muted">Ensure your account is using a long, random password to stay secure.</p>
</div>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <!-- Current Password -->
    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password">
        @if ($errors->updatePassword->has('current_password'))
            <div class="text-danger mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
        @endif
    </div>

    <!-- New Password -->
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
        @if ($errors->updatePassword->has('password'))
            <div class="text-danger mt-1">{{ $errors->updatePassword->first('password') }}</div>
        @endif
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
        @if ($errors->updatePassword->has('password_confirmation'))
            <div class="text-danger mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">Save</button>

        @if (session('status') === 'password-updated')
            <small class="text-success">Saved.</small>
        @endif
    </div>
</form>
