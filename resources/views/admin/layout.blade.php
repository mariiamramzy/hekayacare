@extends('admin.layout.master')

@section('main-content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="success-box">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                <strong>Validation error:</strong>
                <ul style="margin: 8px 0 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
@endsection
