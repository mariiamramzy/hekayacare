@extends('admin.layout')

@section('title', 'Create Item')

@section('content')
    <section class="card">
        <h2 class="page-title">Create Section Item</h2>
        <form method="POST" action="{{ route('admin.pages.sections.items.store', [$page, $section]) }}" enctype="multipart/form-data">
            @csrf
            @include('admin.items._form', ['buttonText' => 'Create Item'])
        </form>
    </section>
@endsection
