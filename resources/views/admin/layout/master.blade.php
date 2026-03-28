<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    @include('admin.layout.head')
    @include('admin.layout.css')
</head>
<body class="rtl">
    <div class="app-wrapper">
        <div class="loader-wrapper">
            <div class="app-loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        @include('admin.layout.sidebar')
        <button class="admin-sidebar-backdrop" type="button" aria-label="Close sidebar"></button>

        <div class="app-content">
            @include('admin.layout.header')

            <main>
                @yield('main-content')
            </main>

            @include('admin.layout.footer')
        </div>
    </div>

   

    @include('admin.layout.script')
</body>
</html>
