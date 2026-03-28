@extends('admin.layout')

@section('title', 'تعديل قصة الشفاء')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل قصة الشفاء #{{ $portfolioCase->id }}</h2>
        <form method="POST" action="{{ route('admin.portfolio-cases.update', $portfolioCase) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.portfolio-cases._form', ['buttonText' => 'حفظ التعديلات'])
        </form>
    </section>
@endsection
