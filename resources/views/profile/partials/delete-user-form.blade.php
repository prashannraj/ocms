<div class="mb-4">
    <h4 class="mb-2">Delete Account</h4>
    <p class="text-muted">
        Once your account is deleted, all of its resources and data will be permanently deleted. 
        Please download any data or information that you wish to retain before continuing.
    </p>
</div>

<!-- Delete Button triggers Modal -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
    Delete Account
</button>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
        @csrf
        @method('DELETE')

        <div class="modal-header">
            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Account Deletion</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <p>
                Are you sure you want to delete your account? Once deleted, all resources and data will be permanently removed.
            </p>

            <div class="mb-3">
                <label for="password" class="form-label">Enter Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                @if ($errors->userDeletion->has('password'))
                    <div class="text-danger mt-1">
                        {{ $errors->userDeletion->first('password') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </div>
    </form>
  </div>
</div>
