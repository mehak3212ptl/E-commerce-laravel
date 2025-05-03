@extends('adminlayout.adminmaster')

@section('content')
<div class="container">
    <h2>Edit Feature for "{{ $feature->plan->name }}"</h2>
    <form action="{{ route('features.update', $feature->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label>Description</label>
            <input type="text" name="description" value="{{ old('description', $feature->description) }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('plans.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

