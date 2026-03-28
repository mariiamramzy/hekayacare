@extends('admin.layout')

@section('title', 'Edit Admin')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit Admin #{{ $admin->id }}</h2>
        <form method="POST" action="{{ route('admin.admins.update', $admin) }}">
            @csrf
            @method('PUT')
            @include('admin.admins._form', ['buttonText' => 'Update Admin'])
        </form>
    </section>
@endsection
