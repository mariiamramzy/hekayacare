@extends('admin.layout')

@section('title', 'Create Role')

@section('content')
    <section class="card">
        <h2 class="page-title">Create Role</h2>
        <form method="POST" action="{{ route('admin.roles.store') }}">
            @csrf
            @include('admin.roles._form', ['buttonText' => 'Create Role'])
        </form>
    </section>
@endsection
