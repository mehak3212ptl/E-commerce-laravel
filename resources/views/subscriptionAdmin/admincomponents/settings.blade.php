@extends('subscriptionAdmin.adminlayout.adminmaster')
@section('content')
<div class="container py-5" >
    <div class="row g-4">
        @php
            $tiles = [
                ['icon' => 'bi-brush', 'title' => 'Branding', 'desc' => 'Logo, Site Name'],
                ['icon' => 'bi-gear', 'title' => 'General Settings', 'desc' => 'Default EULA and more'],
                ['icon' => 'bi-shield-lock', 'title' => 'Security', 'desc' => 'Two-Factor, Password Restrictions'],
                ['icon' => 'bi-people', 'title' => 'Groups', 'desc' => 'Account permission groups'],
                ['icon' => 'bi-translate', 'title' => 'Localization', 'desc' => 'Language, date display'],
                ['icon' => 'bi-bell', 'title' => 'Notifications', 'desc' => 'Email alerts'],
                ['icon' => 'bi-slack', 'title' => 'Slack', 'desc' => 'Slack settings'],
                ['icon' => 'bi-tags', 'title' => 'Asset Tags', 'desc' => 'Incrementing and prefixes'],
                ['icon' => 'bi-upc-scan', 'title' => 'Barcodes', 'desc' => 'Barcode & QR settings'],
                ['icon' => 'bi-tags-fill', 'title' => 'Labels', 'desc' => 'Label sizes & settings'],
                ['icon' => 'bi-diagram-3', 'title' => 'LDAP', 'desc' => 'LDAP/Active Directory'],
                ['icon' => 'bi-hdd-network', 'title' => 'Backups', 'desc' => 'Download files & data'],
              
            ];
        @endphp

        @foreach($tiles as $tile)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center shadow-sm h-100 border-0 hover-shadow transition">
                <div class="card-body py-4">
                    <i class="bi {{ $tile['icon'] }} fs-2 text-primary mb-3"></i>
                    <h6 class="fw-bold">{{ $tile['title'] }}</h6>
                    <p class="text-muted small">{{ $tile['desc'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection