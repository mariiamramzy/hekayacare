@extends('admin.layout')

@section('title', 'إضافة تصنيف أسئلة')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة تصنيف أسئلة</h2>
        <form method="POST" action="{{ route('admin.faq-categories.store') }}">
            @csrf
            @include('admin.faq-categories._form', ['buttonText' => 'حفظ التصنيف'])
        </form>
    </section>
@endsection
