@extends('admin.layout')

@section('title', 'Create Page')

@section('content')
    <section class="card">
        <h2 class="page-title">Create CMS Page</h2>
        <form method="POST" action="{{ route('admin.pages.store') }}">
            @csrf
            @include('admin.pages._form', ['buttonText' => 'Create Page'])
        </form>
    </section>
@endsection
