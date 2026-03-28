@extends('admin.layout')

@section('title', 'Edit Section')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit Section #{{ $section->id }} for: {{ $page->title_ar }}</h2>
        <form method="POST" action="{{ route('admin.pages.sections.update', [$page, $section]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.sections._form', ['buttonText' => 'Update Section'])
        </form>
    </section>
@endsection
