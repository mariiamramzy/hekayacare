@extends('admin.layout')

@section('title', 'Edit Role')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit Role #{{ $role->id }}</h2>
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            @include('admin.roles._form', ['buttonText' => 'Update Role'])
        </form>
    </section>
@endsection
