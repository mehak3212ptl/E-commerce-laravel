@extends('subscriptionAdmin.adminlayout.adminmaster')


@section('content')
<div class="container">
    <h2>Create Plan</h2>
    <form action="{{ route('plans.store') }}" method="POST">
        @include('plans._form')
    </form>
</div>
@endsection
