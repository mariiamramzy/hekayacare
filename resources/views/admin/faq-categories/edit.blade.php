@extends('admin.layout')

@section('title', 'Edit FAQ Category')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit FAQ Category #{{ $faqCategory->id }}</h2>
        <form method="POST" action="{{ route('admin.faq-categories.update', $faqCategory) }}">
            @csrf
            @method('PUT')
            @include('admin.faq-categories._form', ['buttonText' => 'Update Category'])
        </form>
    </section>
@endsection
