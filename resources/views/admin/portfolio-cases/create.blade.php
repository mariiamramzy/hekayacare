@extends('admin.layout')

@section('title', 'إضافة قصة شفاء')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة قصة شفاء</h2>
        <form method="POST" action="{{ route('admin.portfolio-cases.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.portfolio-cases._form', ['buttonText' => 'حفظ القصة'])
        </form>
    </section>
@endsection
