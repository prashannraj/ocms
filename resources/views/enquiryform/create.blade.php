@extends('layouts.app')

@section('title', 'Create Enquiry Form')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="mb-4">
        <h2>Enquiry Form</h2>
        <a href="/" class="btn btn-secondary btn-sm">
            <i class="fas fa-chevron-left"></i> Back to dashboard
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('enquiryform.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    @include('enquiryform.form') {{-- your form partial --}}

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary" name="action" value="apd">Submit</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        initiateTinymce('textarea.wysiwyg');
    </script>
@endpush
