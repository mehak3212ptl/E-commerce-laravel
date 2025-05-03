@extends('adminlayout.adminmaster')

@section('content')
<div class="container">
    <h2>Edit Plan</h2>
    <form action="{{ route('plans.update', $plan->id) }}" method="POST">
        @method('PUT')
        @include('plans.__form', ['plan' => $plan])
    </form>
</div>
@endsection
