@extends('admin.layout')

@section('title', 'Edit Permission')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit Permission #{{ $permission->id }}</h2>
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            @csrf
            @method('PUT')
            @include('admin.permissions._form', ['buttonText' => 'Update Permission'])
        </form>
    </section>
@endsection
