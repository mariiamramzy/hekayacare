@extends('admin.layout')

@section('title', 'Create Admin')

@section('content')
    <section class="card">
        <h2 class="page-title">Create Admin</h2>
        <form method="POST" action="{{ route('admin.admins.store') }}">
            @csrf
            @include('admin.admins._form', ['buttonText' => 'Create Admin'])
        </form>
    </section>
@endsection
