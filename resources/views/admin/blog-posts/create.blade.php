@extends('admin.layout')

@section('title', 'إضافة مقال')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/trumbowyg/trumbowyg.min.css') }}">
@endsection

@section('content')
    <section class="card">
        <h2 class="page-title">إضافة مقال</h2>
        <form method="POST" action="{{ route('admin.blog-posts.store') }}" enctype="multipart/form-data">
            @csrf
            @include('admin.blog-posts._form', ['buttonText' => 'حفظ المقال'])
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
    <script>
        (function () {
            if (typeof window.jQuery === 'undefined') {
                return;
            }

            window.jQuery(function ($) {
                const $editor = $('#content_ar');
                if (!$editor.length || typeof $editor.trumbowyg === 'undefined') {
                    return;
                }

                $editor.trumbowyg({
                    btns: [
                        ['viewHTML'],
                        ['undo', 'redo'],
                        ['formatting'],
                        ['strong', 'em', 'del'],
                        ['link'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['removeformat'],
                        ['fullscreen']
                    ]
                });
            });
        })();
    </script>
    @stack('scripts')
@endsection
