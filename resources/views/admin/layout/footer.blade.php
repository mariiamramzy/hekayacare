@php($isSuperAdmin = auth('admin')->user()?->isSuperAdmin() ?? false)

<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 col-12">
                <ul class="footer-text">
                    <li>
                        <p class="mb-0">Copyright &copy; {{ date('Y') }} Hekaya Admin. All rights reserved.</p>
                    </li>
                    <li><a href="#">V1.0.0</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <ul class="footer-text text-end">
                </ul>
            </div>
        </div>
    </div>
</footer>
