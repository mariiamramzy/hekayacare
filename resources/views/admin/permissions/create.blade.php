@extends('admin.layout')

@section('title', 'Create Permission')

@section('content')
    <section class="card">
        <h2 class="page-title">Create Permission</h2>
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            @include('admin.permissions._form', ['buttonText' => 'Create Permission'])
        </form>
    </section>
@endsection
