@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container">
    <h2 class="mb-4">Profile</h2>

    {{-- Update Profile Information --}}
    <div class="card mb-4">
        <div class="card-header">Update Profile Information</div>
        <div class="card-body">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- Update Password --}}
    <div class="card mb-4">
        <div class="card-header">Update Password</div>
        <div class="card-body">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    {{-- Delete Account --}}
    <div class="card mb-4">
        <div class="card-header">Delete Account</div>
        <div class="card-body">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
