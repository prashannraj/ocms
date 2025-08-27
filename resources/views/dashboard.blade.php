@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mt-4">
  @foreach ([
    ['title'=>'Sales', 'value'=>'$8,753.00', 'change'=>'18.33%', 'bg'=>'warning'],
    ['title'=>'Margin', 'value'=>'$5,300.00', 'change'=>'13.21%', 'bg'=>'pink'],
    ['title'=>'Orders', 'value'=>'$1,753.00', 'change'=>'67.98%', 'bg'=>'primary'],
    ['title'=>'Affiliate', 'value'=>'2368', 'change'=>'20.32%', 'bg'=>'info'],
  ] as $card)
    <div class="col-md-3 mb-4">
      <div class="card text-white bg-{{ $card['bg'] }}">
        <div class="card-body">
          <h5 class="card-title">{{ $card['title'] }}</h5>
          <h3>{{ $card['value'] }}</h3>
          <small>{{ $card['change'] }} Since last month</small>
        </div>
      </div>
    </div>
  @endforeach
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Business Survey</h5>
    <div class="row text-center mb-3">
      <div class="col"><strong>Today Earnings</strong><br>$5,300</div>
      <div class="col"><strong>Product Sold</strong><br>$9,100</div>
      <div class="col"><strong>Today Orders</strong><br>$4,354</div>
    </div>
    <div style="height: 300px;" class="bg-light d-flex justify-content-center align-items-center">
      <em>[ Chart.js placeholder ]</em>
    </div>
    <p class="mt-3">Sales Revenue: <strong>$2,45,500</strong> <span class="text-muted">last 8 months</span></p>
  </div>
</div>
@endsection
