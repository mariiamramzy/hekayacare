@extends('admin.layout')

@section('title', 'إضافة مريض')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة مريض</h2>

        <form method="POST" action="{{ route('admin.patients.store') }}">
            @csrf
            @include('admin.patients._form')

            <div class="actions">
                <button class="btn btn-primary" type="submit">حفظ</button>
                <a class="btn btn-secondary" href="{{ route('admin.patients.index') }}">إلغاء</a>
            </div>
        </form>
    </section>
@endsection
