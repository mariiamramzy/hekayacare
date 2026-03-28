@extends('admin.layout')

@section('title', 'Edit Patient')

@section('content')
    <section class="card">
        <h2 class="page-title">تعديل بيانات المريض #{{ $patient->id }}</h2>

        <form method="POST" action="{{ route('admin.patients.update', $patient) }}">
            @csrf
            @method('PUT')
            @include('admin.patients._form')

            <div class="actions">
                <button class="btn btn-primary" type="submit">تحديث</button>
                <a class="btn btn-secondary" href="{{ route('admin.patients.index') }}">إلغاء</a>
            </div>
        </form>
    </section>
@endsection
