@extends('admin.layout')

@section('title', 'Create FAQ Category')

@section('content')
    <section class="card">
        <h2 class="page-title">Create FAQ Category</h2>
        <form method="POST" action="{{ route('admin.faq-categories.store') }}">
            @csrf
            @include('admin.faq-categories._form', ['buttonText' => 'Create Category'])
        </form>
    </section>
@endsection
