@extends('admin.layout')

@section('title', 'إضافة خدمة')

@section('content')
    <section class="card card-body-soft">
        <h2 class="page-title">إضافة خدمة</h2>

        <form method="POST" action="{{ route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form', ['buttonText' => 'حفظ الخدمة'])
        </form>
    </section>
@endsection
