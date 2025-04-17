@extends('adminlayout.adminmaster')
@section('content')
<div class="container-fluid px-4 py-4" style="margin-left:110px"> {{-- Fluid for full width, px-4 for padding away from sidebar --}}
    <!-- Top Stats -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="mb-1">In the Last 30 Days</h5>
            <p class="mb-1">👤 <strong>2,999,999</strong> Customers</p>
            <p class="mb-0">📈 <strong>12,999,999</strong> Sessions</p>
        </div>
    
    </div>

    <!-- User Cards -->
    <div class="row g-4 text-center">
        @php
            $cards = [
                ['count' => '164', 'title' => 'New Users', 'color' => '#ff6f61'],
                ['count' => '292', 'title' => 'Engaged Users', 'color' => '#9b59b6'],
                ['count' => '1,000', 'title' => 'Passerbys', 'color' => '#1abc9c'],
                ['count' => '408', 'title' => 'Lapsed Users', 'color' => '#e74c3c'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card p-3 shadow-sm h-100">
                <div style="width:110px;height:110px;border-radius:50%;border:6px solid {{ $card['color'] }};display:flex;align-items:center;justify-content:center;font-size:22px;font-weight:600;margin:0 auto 1rem auto;">
                    {{ $card['count'] }}
                </div>
                <h6 class="mb-0">{{ $card['title'] }}</h6>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Descriptions -->
    <h5 class="mt-5 mb-3">What Are These Four Categories?</h5>
    <div class="row g-4">
        <div class="col-md-3">
            <strong>New Users</strong>
            <p class="small">New people who have used your app for the very first time in the last 7 days.</p>
        </div>
        <div class="col-md-3">
            <strong>Engaged Users</strong>
            <p class="small">People who have used your app on multiple days and at least once in the last 14 days.</p>
        </div>
        <div class="col-md-3">
            <strong>Passerbys</strong>
            <p class="small">Newbies to the app who have not returned within the last 7 days.</p>
        </div>
        <div class="col-md-3">
            <strong>Lapsed Users</strong>
            <p class="small">Previously Engaged people who haven't used the app in 14 days or more.</p>
        </div>
    </div>
</div>
@endsection
