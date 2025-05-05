@extends('subscriptionAdmin.adminlayout.adminmaster')

@section('content')
<div class="container">
    <h2>Plans</h2>
    <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Add Plan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Currency</th>
                <th>Popular</th>
                <th>Max Websites</th>
                <th>Storage (GB)</th>
                <th>Features</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>{{ $plan->price }}</td>
                    <td>{{ $plan->currency }}</td>
                    <td>{{ $plan->is_popular ? 'Yes' : 'No' }}</td>
                    <td>{{ $plan->max_websites ?? 'Unlimited' }}</td>
                    <td>{{ $plan->storage_limit }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach ($plan->features as $feature)
                                <li class="mb-1">
                                    {{ $feature->description }}
                                    <a href="{{ route('features.edit', $feature->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <form action="{{ route('features.destroy', $feature->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this feature?')">Delete</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('features.create') }}?plan_id={{ $plan->id }}" class="btn btn-sm btn-secondary mt-1">Add Feature</a>
                    </td>
                    <td>
                        <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('plans.destroy', $plan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this plan?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
