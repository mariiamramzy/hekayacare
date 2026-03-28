<!-- latest jquery-->
<script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('assets/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>

<!-- Simple bar js-->
<script src="{{asset('assets/vendor/simplebar/simplebar.js')}}"></script>

<!-- phosphor js -->
<script src="{{asset('assets/vendor/phosphor/phosphor.js')}}"></script>



<!-- prism js-->
<script src="{{asset('assets/vendor/prism/prism.min.js')}}"></script>

<!-- App js-->
<script src="{{asset('assets/js/script.js')}}"></script>

<!-- DataTable js -->
<script src="{{ asset('assets/vendor/datatable/jquery.dataTables.min.js') }}"></script>

<script>
    (function () {
        if (typeof window.jQuery === 'undefined' || typeof window.jQuery.fn.DataTable === 'undefined') {
            return;
        }

        window.jQuery(function ($) {
            $('.table-wrap table').each(function () {
                const $table = $(this);

                if ($.fn.DataTable.isDataTable(this) || $table.hasClass('no-datatable')) {
                    return;
                }

                const columnCount = $table.find('thead tr').last().children('th, td').length;
                if (!columnCount) {
                    return;
                }

                // Remove placeholder/malformed rows (e.g. empty-state rows with colspan)
                // to avoid DataTables "Incorrect column count" warning.
                $table.find('tbody tr').each(function () {
                    const $row = $(this);
                    const $cells = $row.children('th, td');
                    const hasSpan = $cells.filter(function () {
                        const colspan = parseInt($(this).attr('colspan') || '1', 10);
                        const rowspan = parseInt($(this).attr('rowspan') || '1', 10);
                        return colspan !== 1 || rowspan !== 1;
                    }).length > 0;

                    if (hasSpan || $cells.length !== columnCount) {
                        $row.remove();
                    }
                });

                $table.addClass('display table-bottom-border app-data-table table-box-hover');

                $table.DataTable({
                    paging: true,
                    info: true,
                    responsive: true,
                    autoWidth: false,
                    order: [],
                    pageLength: 25,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'الكل']],
                    language: {
                        search: 'بحث:',
                        lengthMenu: 'عرض _MENU_ عنصر',
                        info: 'عرض _START_ إلى _END_ من أصل _TOTAL_ عنصر',
                        infoEmpty: 'عرض 0 إلى 0 من أصل 0 عنصر',
                        infoFiltered: '(تمت التصفية من أصل _MAX_ عنصر)',
                        zeroRecords: 'لا توجد نتائج مطابقة',
                        emptyTable: 'لا توجد بيانات متاحة',
                        paginate: {
                            first: 'الأول',
                            last: 'الأخير',
                            next: 'التالي',
                            previous: 'السابق'
                        }
                    }
                });
            });
        });
    })();
</script>

<script>
    (function () {
        var wrapper = document.querySelector('.app-wrapper');
        var nav = document.querySelector('.app-wrapper nav');
        var toggle = document.querySelector('.header-toggle');
        var closeToggle = document.querySelector('.toggle-semi-nav');
        var backdrop = document.querySelector('.admin-sidebar-backdrop');

        if (!wrapper || !nav || !toggle) {
            return;
        }

        function isMobileSidebar() {
            return window.innerWidth < 1200;
        }

        function closeMobileSidebar() {
            wrapper.classList.remove('sidebar-mobile-open');
        }

        function openMobileSidebar() {
            wrapper.classList.add('sidebar-mobile-open');
        }

        toggle.addEventListener('click', function (event) {
            if (!isMobileSidebar()) {
                return;
            }

            event.preventDefault();
            wrapper.classList.toggle('sidebar-mobile-open');
        });

        if (closeToggle) {
            closeToggle.addEventListener('click', function () {
                if (isMobileSidebar()) {
                    closeMobileSidebar();
                }
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', closeMobileSidebar);
        }

        nav.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                if (isMobileSidebar() && !link.hasAttribute('data-bs-toggle')) {
                    closeMobileSidebar();
                }
            });
        });

        window.addEventListener('resize', function () {
            if (!isMobileSidebar()) {
                closeMobileSidebar();
            }
        });
    })();
</script>

<script>
    (function () {
        var input = document.getElementById('admin-header-search-input');
        var results = document.getElementById('admin-header-search-results');
        var empty = document.getElementById('admin-header-search-empty');
        var helper = document.getElementById('admin-search-helper');

        if (!input || !results) {
            return;
        }

        var links = [];

        try {
            links = JSON.parse(results.dataset.links || '[]');
        } catch (error) {
            links = [];
        }

        function escapeHtml(value) {
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function render(items) {
            if (!items.length) {
                results.innerHTML = '';
                empty.classList.remove('d-none');
                if (helper) {
                    helper.classList.add('d-none');
                }
                return;
            }

            results.innerHTML = items.map(function (item) {
                return '' +
                    '<a href="' + escapeHtml(item.url) + '" class="admin-header-search-item">' +
                        '<span class="admin-header-search-item__icon"><i class="' + escapeHtml(item.icon) + '"></i></span>' +
                        '<span class="admin-header-search-item__content">' +
                            '<strong>' + escapeHtml(item.label) + '</strong>' +
                            '<small>' + escapeHtml(item.url) + '</small>' +
                        '</span>' +
                    '</a>';
            }).join('');

            empty.classList.add('d-none');
            if (helper) {
                helper.classList.remove('d-none');
            }
        }

        input.addEventListener('input', function () {
            var query = input.value.trim().toLowerCase();

            if (!query) {
                render(links);
                return;
            }

            var filtered = links.filter(function (item) {
                return item.label.toLowerCase().includes(query) || item.url.toLowerCase().includes(query);
            });

            render(filtered);
        });
    })();
</script>

@yield('script')
