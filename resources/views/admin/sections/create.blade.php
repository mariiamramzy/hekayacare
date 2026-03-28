@extends('admin.layout')

@section('title', 'Create Section')

@section('content')
    <section class="card">
        <h2 class="page-title">Create Section for: {{ $page->title_ar }}</h2>
        <form method="POST" action="{{ route('admin.pages.sections.store', $page) }}" enctype="multipart/form-data">
            @csrf
            @include('admin.sections._form', ['buttonText' => 'Create Section'])
        </form>
    </section>
@endsection
