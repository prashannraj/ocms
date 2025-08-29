<div class="col-md-4">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" autocomplete="off" name="name" value="{{ old('name', $form->name ?? '') }}" class="form-control">
        @if ($errors->has('name'))
            <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" autocomplete="off" name="title" value="{{ old('title', $form->title ?? '') }}" class="form-control">
        @if ($errors->has('title'))
            <span class="text-danger">{{ $errors->first('title') }}</span>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="">Select status of this form</option>
            @foreach (['active', 'inactive'] as $status)
                <option value="{{ $status }}" {{ old('status', $form->status ?? '') === $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('status'))
            <span class="text-danger">{{ $errors->first('status') }}</span>
        @endif
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="type" class="form-control">
            <option value="">Select type of this form</option>
            @foreach (config('constant.enquiry_form_types') as $key => $type)
                <option value="{{ $key }}" {{ old('type', $form->type ?? '') === $key ? 'selected' : '' }}>
                    {{ $type }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('type'))
            <span class="text-danger">{{ $errors->first('type') }}</span>
        @endif
    </div>
</div>
