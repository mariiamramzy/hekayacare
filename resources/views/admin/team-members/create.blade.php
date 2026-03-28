@extends('admin.layout')

@section('title', 'إضافة عضو فريق')

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة عضو فريق</h2>
        <form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.team-members._form', ['buttonText' => 'حفظ العضو'])
        </form>
    </section>
@endsection
