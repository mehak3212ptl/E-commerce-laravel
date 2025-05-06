@extends('frontend.usermaster')
@section('content')

<div class="container py-5">
    <h1 class="text-center mb-5 fw-bold text-primary">About Us</h1>

    @if($about)
    <div class="row align-items-center">
        {{-- Left: Image --}}
        <div class="col-md-6 mb-4 mb-md-0">
            @if ($about->image)
                <<img src="/Upload/about/{{ basename($about->image) }}" 
                     class="img-fluid rounded shadow" 
                     alt="About Image" style="max-height: 400px; object-fit: cover; width: 100%;">
            @endif
        </div>

        {{-- Right: Title + Description --}}
        <div class="col-md-6">
            <h2 class="h3 fw-bold mb-3 text-dark">{{ $about->title }}</h2>
            <div class="text-muted" style="font-size: 1.1rem;">
                {!! $about->description !!}
            </div>
        </div>
    </div>
    @else
        <p class="text-center text-secondary">Content not available yet.</p>
    @endif
</div>

@endsection
