@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mt-4">
  {{-- Example cards: Total Users, Total Roles, Users Today, Latest Users Count --}}
  @php
    $cards = [
      ['title' => 'Total Users', 'value' => $data['totalUsers'], 'change' => 'N/A', 'bg' => 'primary'],
      ['title' => 'Total Roles', 'value' => $data['totalRoles'], 'change' => 'N/A', 'bg' => 'info'],
      ['title' => 'Total Enquiry Forms', 'value' => $data['totalEnquiryForms'], 'change' => 'N/A', 'bg' => 'success'],
      ['title' => 'Latest 5 Users', 'value' => count($data['latestUsers']), 'change' => 'N/A', 'bg' => 'warning'],
    ];
  @endphp

  @foreach ($cards as $card)
    <div class="col-md-3 mb-4">
      <div class="card text-white bg-{{ $card['bg'] }}">
        <div class="card-body">
          <h5 class="card-title">{{ $card['title'] }}</h5>
          <h3>{{ $card['value'] }}</h3>
          <small>{{ $card['change'] !== 'N/A' ? $card['change'].' Since last month' : '' }}</small>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">User Registrations Over Time</h5>
    <ul>
      <li>Last 30 days: {{ $data['userRegistrations'][0] }}</li>
      <li>Last 3 months: {{ $data['userRegistrations'][1] }}</li>
      <li>Last 6 months: {{ $data['userRegistrations'][2] }}</li>
      <li>Last 1 year: {{ $data['userRegistrations'][3] }}</li>
    </ul>
  </div>
</div>

<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Enquiry Form Registrations Over Time</h5>
    <ul>
      <li>Last 30 days: {{ $data['enquiryRegistrations'][0] }}</li>
      <li>Last 3 months: {{ $data['enquiryRegistrations'][1] }}</li>
      <li>Last 6 months: {{ $data['enquiryRegistrations'][2] }}</li>
      <li>Last 1 year: {{ $data['enquiryRegistrations'][3] }}</li>
    </ul>
  </div>
</div>

<div class="card mb-4">
  <div class="card-body">
    <h5 class="card-title">Users by Role</h5>
    <ul>
      @foreach ($data['rolesWithUserCount'] as $role)
        <li>{{ $role->name }}: {{ $role->users_count }} users</li>
      @endforeach
    </ul>
  </div>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Latest 5 Users</h5>
    <ul>
      @foreach ($data['latestUsers'] as $user)
        <li>{{ $user->name }} ({{ $user->email }})</li>
      @endforeach
    </ul>
  </div>
</div>
@endsection
