@extends('admin.layout')

@section('title', 'Edit Item')

@section('content')
    <section class="card">
        <h2 class="page-title">Edit Section Item #{{ $item->id }}</h2>
        <form method="POST" action="{{ route('admin.pages.sections.items.update', [$page, $section, $item]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.items._form', ['buttonText' => 'Update Item'])
        </form>
    </section>
@endsection
