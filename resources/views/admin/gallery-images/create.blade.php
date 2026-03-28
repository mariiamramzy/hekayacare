@extends('admin.layout')

@section('title', 'إضافة صورة جاليري')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة صورة جاليري</h2>
        <form method="POST" action="{{ route('admin.gallery-images.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.gallery-images._form', ['buttonText' => 'حفظ الصورة'])
        </form>
    </section>
@endsection
