@extends('adminlayout.adminmaster')

@section('content')
<div class="container">
    <h2>Add Feature to "{{ $plan->name }}"</h2>
    <form action="{{ route('features.store') }}" method="POST">
        @csrf
        <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        <div class="mb-3">
            <label>Feature Description</label>
            <input type="text" name="description" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Feature</button>
        <a href="{{ route('plans.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
