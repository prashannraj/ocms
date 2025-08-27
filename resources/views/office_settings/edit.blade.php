@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Office Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @include('office_settings._form', ['officeSetting' => $officeSetting])
</div>
@endsection
