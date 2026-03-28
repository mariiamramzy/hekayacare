<!--font-awesome-css-->
<link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.css') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap" rel="stylesheet">

<!-- tabler icons-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.css') }}">

<!--flag Icon css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flag-icons-master/flag-icon.css') }}">

<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">

<!-- DataTable css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatable/jquery.dataTables.min.css') }}">

<!-- simplebar css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/simplebar/simplebar.css') }}">

<!-- Prism css-->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/prism/prism.min.css') }}">

@yield('css')

@if(file_exists(public_path('build/manifest.json')))
    @vite(['public/assets/scss/style.scss'])
@else
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
@endif

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

<style>
    :root {
        --admin-sidebar-width: 17rem;
        --admin-sidebar-collapsed-width: 4.5rem;
        --admin-surface: #ffffff;
        --admin-border: #e6ebf2;
        --admin-shadow: 0 16px 40px rgba(21, 38, 75, 0.06);
    }

    body {
        background: #f4f7fb;
        color: #15264b;
        font-family: "Noto Kufi Arabic", sans-serif;
        direction: rtl;
        text-align: right;
    }

    input,
    select,
    textarea,
    button {
        font-family: inherit;
    }

    body,
    p,
    span,
    li,
    label,
    td,
    th,
    .card,
    .card-body {
        color: #243b63;
    }

    .app-wrapper {
        min-height: 100vh;
        background: #f4f7fb;
    }

    html[dir="rtl"] nav {
        right: 0;
        left: auto;
        border-radius: 25px 0 0 25px;
    }

    html[dir="rtl"] .app-wrapper .app-content {
        padding-right: var(--admin-sidebar-width);
        padding-left: 0;
    }

    html[dir="rtl"] .app-wrapper .semi-nav ~ .app-content {
        padding-right: var(--admin-sidebar-collapsed-width);
        padding-left: 0;
    }

    html[dir="rtl"] header.header-main {
        padding-right: calc(var(--admin-sidebar-width) + 16px);
        padding-left: 16px;
    }

    html[dir="rtl"] .app-wrapper .semi-nav ~ .app-content header.header-main {
        padding-right: calc(var(--admin-sidebar-collapsed-width) + 16px);
        padding-left: 16px;
    }

    nav {
        z-index: 1003;
        border-left: 1px solid var(--admin-border);
        border-right: 0;
    }

    .app-content,
    main,
    .card,
    .card-body,
    .table-wrap,
    .dataTables_wrapper,
    .dropdown-menu {
        direction: rtl;
    }

    .admin-sidebar-backdrop {
        display: none;
        border: 0;
        padding: 0;
        background: rgba(15, 23, 42, 0.42);
    }

    .app-logo {
        position: relative;
        padding: 12px 16px 18px;
        margin-bottom: 6px;
    }

    .app-logo .logo {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        min-height: 72px;
        width: 100%;
        padding-right: 48px;
        gap: 12px;
    }

    .app-logo .logo img {
        max-width: 100%;
        max-height: 100%;
        height: auto;
        width: auto;
        display: block;
    }

    .admin-sidebar-logo {
        overflow: hidden;
        text-decoration: none;
        color: #102d57;
    }

    .admin-sidebar-logo__mark {
        width: 56px;
        height: 56px;
        flex: 0 0 56px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(60, 167, 168, 0.12), rgba(128, 190, 0, 0.14));
        border: 1px solid rgba(16, 45, 87, 0.08);
        overflow: hidden;
    }

    .admin-sidebar-logo__mark img {
        width: 42px;
        height: 42px;
        object-fit: contain;
    }

    .admin-sidebar-logo__text {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
        line-height: 1.1;
    }

    .admin-sidebar-logo__text strong {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: 0.01em;
        color: #102d57;
    }

    .admin-sidebar-logo__text small {
        font-size: 11px;
        font-weight: 600;
        color: #5f6f89;
        text-transform: uppercase;
        letter-spacing: 0.08em;
    }

    .app-logo .toggle-semi-nav {
        position: absolute;
        top: 20px;
        right: 16px;
        z-index: 2;
    }

    .semi-nav .app-logo {
        padding-left: 10px;
        padding-right: 10px;
    }

    .semi-nav .app-logo .logo {
        justify-content: center;
        padding-right: 0;
        min-height: 56px;
        gap: 0;
    }

    .semi-nav .admin-sidebar-logo__text {
        display: none;
    }

    .semi-nav .admin-sidebar-logo__mark {
        width: 42px;
        height: 42px;
        flex-basis: 42px;
        border-radius: 12px;
    }

    .semi-nav .admin-sidebar-logo__mark img {
        width: 30px;
        height: 30px;
    }

    .app-wrapper .app-content {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding-top: 80px;
        padding-bottom: 0;
    }

    .app-wrapper .semi-nav ~ .app-content {
        padding-left: var(--admin-sidebar-collapsed-width);
    }

    header.header-main {
        left: 0;
        right: 0;
        width: auto;
        padding-left: calc(var(--admin-sidebar-width) + 16px);
        padding-right: 16px;
        background: transparent;
    }

    .app-wrapper .semi-nav ~ .app-content header.header-main {
        padding-left: calc(var(--admin-sidebar-collapsed-width) + 16px);
    }

    header.header-main .container-fluid {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(230, 235, 242, 0.9);
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(21, 38, 75, 0.05);
    }

    header.header-main .container-fluid::before,
    header.header-main::before {
        display: none;
    }

    main {
        width: 100%;
        margin: 0;
        padding: 24px 0 32px;
        flex: 1 1 auto;
    }

    .container-fluid {
        padding-left: 20px;
        padding-right: 20px;
    }

    .card {
        border: 1px solid var(--admin-border);
        border-radius: 18px;
        box-shadow: var(--admin-shadow);
        background: var(--admin-surface);
        overflow: hidden;
    }

    .app-content main section.card {
        padding: 22px;
    }

    .page-title {
        margin-bottom: 14px;
        color: #102d57;
        font-weight: 700;
    }

    .main-title,
    .header-title-text,
    .card-title,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: #102d57;
    }

    .page-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .stack-card + .stack-card {
        margin-top: 18px;
    }

    .card-body-soft {
        padding: 22px;
    }

    .page-toolbar__title {
        margin: 0;
    }

    .page-toolbar__actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .section-stack {
        display: grid;
        gap: 18px;
    }

    .section-heading {
        margin: 0 0 14px;
        font-size: 18px;
        font-weight: 700;
        color: #102d57;
    }

    .section-intro {
        margin-bottom: 16px;
    }

    .muted {
        color: #6b7280;
    }

    .text-secondary {
        color: #5e708d !important;
    }

    .text-muted,
    small,
    .small {
        color: #6c7d97 !important;
    }

    .btn-light-primary {
        color: #102d57;
        font-weight: 600;
    }

    .app-line-breadcrumbs li a,
    .app-line-breadcrumbs li span {
        color: #4f6484;
    }

    .app-line-breadcrumbs li.active a,
    .app-line-breadcrumbs li:hover a {
        color: #102d57;
    }

    nav .app-nav .menu-title span,
    .app-wrapper .semi-nav .app-nav .menu-title > span {
        color: #7a879b !important;
        font-weight: 700;
        letter-spacing: 0.04em;
    }

    nav .app-nav .main-nav > li:not(.menu-title) > a,
    nav .app-nav .main-nav > li:not(.menu-title) ul li a {
        color: #324968 !important;
        font-weight: 600;
    }

    nav .app-nav .main-nav > li:not(.menu-title) > a i,
    nav .app-nav .main-nav > li:not(.menu-title) > a::after {
        color: #556b89 !important;
    }

    nav .app-nav .main-nav > li:not(.menu-title) > a:hover,
    nav .app-nav .main-nav > li:not(.menu-title) ul li a:hover {
        color: #102d57 !important;
    }

    .actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .table-wrap {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border: 1px solid var(--admin-border);
        border-radius: 14px;
    }

    .table-wrap table {
        width: 100%;
        min-width: 760px;
        margin-bottom: 0;
        background: #fff;
    }

    .table-wrap thead th {
        background: #f8fafc;
        color: #102d57;
        font-weight: 700;
        white-space: nowrap;
    }

    .table-wrap tbody td,
    .table-wrap tbody th {
        vertical-align: middle;
    }

    .table-wrap td,
    .table-wrap th {
        padding: 14px 16px;
    }

    .field {
        margin-bottom: 14px;
    }

    .field label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .field input[type="text"],
    .field input[type="email"],
    .field input[type="password"],
    .field input[type="number"],
    .field input[type="url"],
    .field input[type="date"],
    .field input[type="file"],
    .field input[type="datetime-local"],
    .field select,
    .field textarea {
        width: 100%;
        border: 1px solid #d7deea;
        border-radius: 12px;
        padding: 11px 13px;
        font-size: 14px;
        background: #fff;
    }

    .field input[type="text"]:focus,
    .field input[type="email"]:focus,
    .field input[type="password"]:focus,
    .field input[type="number"]:focus,
    .field input[type="url"]:focus,
    .field input[type="date"]:focus,
    .field input[type="datetime-local"]:focus,
    .field select:focus,
    .field textarea:focus {
        outline: none;
        border-color: rgba(72, 190, 206, 0.7);
        box-shadow: 0 0 0 4px rgba(72, 190, 206, 0.14);
    }

    .field textarea {
        min-height: 110px;
        resize: vertical;
    }

    .check-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 8px 14px;
    }

    .error-box {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 12px;
    }

    .success-box {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 12px;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .grid-3 {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
    }

    .form-section {
        padding: 18px;
        border: 1px solid var(--admin-border);
        border-radius: 16px;
        background: #fbfcfe;
    }

    .form-section__title {
        margin: 0 0 14px;
        font-size: 16px;
        font-weight: 700;
        color: #102d57;
    }

    .badge {
        border-radius: 999px;
        padding: 6px 10px;
    }

    .preview-thumb {
        width: 90px;
        height: 60px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid var(--admin-border);
        background: #f8fafc;
    }

    .inline-link-note {
        margin-top: 6px;
        font-size: 13px;
    }

    .empty-cell {
        text-align: center;
        padding: 20px 16px !important;
    }

    .actions form {
        margin: 0;
    }

    .actions .btn,
    .actions button {
        white-space: nowrap;
    }

    .app-content > footer {
        position: static;
        width: 100%;
        margin-top: auto;
        padding: 14px 20px 20px;
        background: transparent;
        border-top: 0;
    }

    .app-content > footer .container-fluid {
        background: #fff;
        border: 1px solid var(--admin-border);
        border-radius: 16px;
        padding-top: 14px;
        padding-bottom: 14px;
        box-shadow: var(--admin-shadow);
    }

    .footer-text {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .footer-text li {
        margin: 0;
    }

    .header-searchbar-canvas {
        border-left: 1px solid var(--admin-border);
        background: #fff;
    }

    .header-profile {
        position: relative;
    }

    .header-profile-dropdown {
        width: 340px;
        height: auto;
        min-height: 220px;
        max-width: calc(100vw - 24px);
        padding: 0;
        border: 1px solid var(--admin-border);
        border-radius: 24px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.14);
        overflow: hidden;
        margin-top: 10px !important;
        position: absolute !important;
        top: calc(100% + 10px) !important;
        right: 0 !important;
        left: auto !important;
        inset: calc(100% + 10px) 0 auto auto !important;
        transform: none !important;
        min-width: 340px;
    }

    header.header-main .container-fluid .header-right .header-profile .header-profile-dropdown {
        right: 0 !important;
        left: auto !important;
        inset: calc(100% + 10px) 0 auto auto !important;
        transform: translate3d(0, 0, 0) !important;
        margin-left: auto !important;
    }

    .header-profile-dropdown__header {
        padding: 16px 18px;
        border-bottom: 1px solid var(--admin-border);
        font-size: 15px;
        font-weight: 700;
        color: #102d57;
        background: #fff;
    }

    .header-profile-dropdown__body {
        padding: 16px;
        background: #fff;
    }

    .header-profile-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px;
        border: 1px solid var(--admin-border);
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(72, 190, 206, 0.08), rgba(166, 204, 52, 0.08));
        margin-bottom: 14px;
    }

    .header-profile .header-profile-dropdown li {
        margin-right: 0 !important;
        padding: 0 !important;
        list-style: none;
    }

    .header-profile .header-profile-dropdown a,
    .header-profile .header-profile-dropdown button {
        display: flex !important;
    }

    .header-profile-card__avatar {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        object-fit: cover;
        flex: 0 0 56px;
    }

    .header-profile-card__content {
        min-width: 0;
    }

    .header-profile-card__content h6 {
        font-size: 18px;
        font-weight: 700;
        color: #102d57;
    }

    .header-profile-card__content p {
        margin-top: 4px;
        color: #5f6f89;
        font-size: 13px;
        word-break: break-word;
    }

    .header-profile-menu {
        list-style: none;
        margin: 0;
        padding: 0 !important;
        display: grid;
        gap: 10px;
    }

    .header-profile-menu li {
        margin: 0;
    }

    .header-profile-menu a,
    .header-profile-menu button {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        background: #fff;
        color: #15264b;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .header-profile-menu a:hover,
    .header-profile-menu button:hover {
        background: #f8fafc;
        border-color: #d7deea;
    }

    .header-profile-menu button {
        text-align: left;
    }

    .header-profile-menu form {
        margin: 0;
    }

    .admin-header-search-results {
        display: grid;
        gap: 10px;
    }

    .admin-header-search-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px;
        border: 1px solid var(--admin-border);
        border-radius: 14px;
        background: #fff;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .admin-header-search-item:hover {
        border-color: #d6deea;
        background: #f8fafc;
    }

    .admin-header-search-item__icon {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(16, 45, 87, 0.06);
        color: #102d57;
        font-size: 18px;
    }

    .admin-header-search-item__content {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .admin-header-search-item__content strong {
        color: #102d57;
        font-size: 14px;
        font-weight: 700;
    }

    .admin-header-search-item__content small {
        color: #6c7d97;
        font-size: 12px;
        line-height: 1.45;
        word-break: break-word;
    }

    .admin-header-search-empty {
        padding: 14px;
        border: 1px dashed #d6deea;
        border-radius: 14px;
        color: #6c7d97;
        background: #fff;
        text-align: center;
        font-weight: 600;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        padding: 12px 0 0;
    }

    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        min-height: 42px;
        border: 1px solid var(--admin-border);
        border-radius: 12px;
        background: #fff;
        color: #243b63;
        padding: 8px 12px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 10px !important;
    }

    .form-control,
    .form-select,
    textarea.form-control {
        min-height: 46px;
        border-radius: 14px;
        border-color: #d8e0ec;
        color: #243b63;
    }

    textarea.form-control {
        min-height: 140px;
    }

    .form-label,
    .col-form-label {
        font-weight: 600;
        color: #183254;
        margin-bottom: 8px;
    }

    .btn {
        min-height: 42px;
        border-radius: 12px;
    }

    .badge {
        border-radius: 999px;
    }

    @media (max-width: 768px) {
        .grid-2 {
            grid-template-columns: 1fr;
        }

        .grid-3 {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 1199px) {
        .admin-sidebar-backdrop {
            display: block;
            position: fixed;
            inset: 0;
            z-index: 1002;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }

        .app-wrapper nav {
            position: fixed;
            top: 12px;
            left: 12px;
            bottom: 12px;
            width: min(320px, calc(100vw - 24px));
            max-width: calc(100vw - 24px);
            border-radius: 22px;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
            overflow: hidden;
            transform: translateX(calc(-100% - 20px));
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            background: #fff;
        }

        .app-wrapper.sidebar-mobile-open nav {
            transform: translateX(0);
        }

        .app-wrapper.sidebar-mobile-open .admin-sidebar-backdrop {
            opacity: 1;
            pointer-events: auto;
        }

        .app-wrapper .app-content,
        .app-wrapper .semi-nav ~ .app-content {
            padding-left: 0;
            padding-top: 88px;
        }

        header.header-main,
        .app-wrapper .semi-nav ~ .app-content header.header-main {
            padding-left: 12px;
            padding-right: 12px;
        }

        main {
            padding-top: 18px;
        }

        .menu-navs {
            display: none;
        }

        .app-logo {
            padding-right: 54px;
        }

        .app-logo .toggle-semi-nav {
            top: 18px;
            right: 14px;
        }

        .app-nav {
            height: calc(100% - 96px);
        }
    }

    @media (max-width: 991px) {
        .container-fluid {
            padding-left: 14px;
            padding-right: 14px;
        }

        header.header-main .container-fluid {
            border-radius: 14px;
        }

        .header-right > ul {
            gap: 2px;
        }

        .table-wrap table {
            min-width: 680px;
        }

        .dashboard-stat-card .card-body,
        .card-body {
            padding: 18px;
        }

        .header-searchbar-canvas {
            width: min(100vw - 24px, 360px) !important;
            max-width: min(100vw - 24px, 360px) !important;
        }
    }

    @media (max-width: 767px) {
        body {
            font-size: 14px;
        }

        .app-wrapper nav {
            top: 10px;
            left: 10px;
            bottom: 10px;
            width: min(300px, calc(100vw - 20px));
            max-width: calc(100vw - 20px);
            border-radius: 18px;
        }

        .app-logo {
            padding: 10px 12px 16px;
            padding-right: 52px;
        }

        .app-nav {
            padding-bottom: 20px;
        }

        nav .app-nav .main-nav > li:not(.menu-title) > a {
            min-height: 46px;
            padding-top: 11px;
            padding-bottom: 11px;
        }

        nav .app-nav .main-nav > li:not(.menu-title) ul li a {
            min-height: 40px;
            padding-top: 9px;
            padding-bottom: 9px;
        }

        .admin-sidebar-logo__mark {
            width: 48px;
            height: 48px;
            flex-basis: 48px;
        }

        .admin-sidebar-logo__mark img {
            width: 34px;
            height: 34px;
        }

        .admin-sidebar-logo__text strong {
            font-size: 22px;
        }

        .admin-sidebar-logo__text small {
            font-size: 10px;
            letter-spacing: 0.05em;
        }

        .app-content main section.card,
        .card-body-soft {
            padding: 16px;
        }

        .row {
            --bs-gutter-x: 16px;
        }

        .app-wrapper .app-content,
        .app-wrapper .semi-nav ~ .app-content {
            padding-top: 82px;
        }

        header.header-main,
        .app-wrapper .semi-nav ~ .app-content header.header-main {
            padding-left: 10px;
            padding-right: 10px;
        }

        header.header-main .container-fluid {
            min-height: 58px;
            border-radius: 16px;
        }

        .header-left .header-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: #f3f6fb;
        }

        .header-right .head-icon {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
        }

        .header-right > ul {
            gap: 6px;
        }

        .page-title {
            font-size: 20px;
            line-height: 1.35;
        }

        .card {
            border-radius: 14px;
        }

        .actions {
            flex-direction: column;
            align-items: stretch;
        }

        .page-toolbar {
            align-items: stretch;
        }

        .page-toolbar .btn {
            width: 100%;
        }

        .page-toolbar__actions {
            width: 100%;
            align-items: stretch;
        }

        .page-toolbar__actions .btn,
        .page-toolbar__actions a,
        .page-toolbar__actions button {
            width: 100%;
        }

        .actions .btn,
        .actions button {
            width: 100%;
        }

        .check-grid {
            grid-template-columns: 1fr;
        }

        .table-wrap table {
            min-width: 620px;
        }

        .table-wrap {
            border-radius: 12px;
        }

        .table-wrap td,
        .table-wrap th {
            padding: 12px 14px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            width: 100%;
            float: none !important;
            text-align: right !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0 !important;
            width: 100%;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            justify-content: flex-start;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin-left: 0 !important;
        }

        .form-control,
        .form-select,
        textarea.form-control {
            font-size: 16px;
        }

        .dashboard-avatar {
            width: 64px;
            height: 64px;
        }

        .dashboard-list {
            max-height: none;
        }

        .activity-list-item {
            align-items: flex-start;
            gap: 10px;
        }

        .activity-list-item .text-end,
        .activity-list-item .flex-shrink-0 {
            min-width: 88px;
        }

        .app-content > footer {
            padding: 10px 12px 16px;
        }

        .app-content > footer .container-fluid {
            padding-left: 14px;
            padding-right: 14px;
        }

        .footer-text {
            justify-content: center;
            text-align: center;
        }

        .header-right .offcanvas,
        .header-profile-dropdown {
            width: min(100vw - 20px, 340px) !important;
            max-width: min(100vw - 20px, 340px) !important;
            border-radius: 18px;
        }

        .header-searchbar-canvas .header-searchbar-header,
        .header-searchbar-canvas .offcanvas-body,
        .header-profile-dropdown__body {
            padding-left: 14px;
            padding-right: 14px;
        }

        .admin-header-search-item {
            padding: 10px;
        }

        .admin-header-search-item__icon {
            width: 36px;
            height: 36px;
            flex-basis: 36px;
            border-radius: 10px;
        }

        .header-profile-dropdown {
            top: calc(100% + 8px) !important;
            right: 0 !important;
            inset: calc(100% + 8px) 0 auto auto !important;
            height: auto;
            min-height: 220px;
        }

        header.header-main .container-fluid .header-right .header-profile .header-profile-dropdown {
            inset: calc(100% + 8px) 0 auto auto !important;
            transform: translate3d(0, 0, 0) !important;
        }

        .header-left .header-toggle {
            margin-right: 0 !important;
        }
    }

    @media (max-width: 575px) {
        .container-fluid {
            padding-left: 12px;
            padding-right: 12px;
        }

        main {
            padding-top: 14px;
            padding-bottom: 24px;
        }

        .app-content main section.card,
        .card-body,
        .card-body-soft {
            padding: 14px;
        }

        .page-title,
        .main-title {
            font-size: 18px;
        }

        .app-line-breadcrumbs {
            flex-wrap: wrap;
            gap: 6px;
        }

        .header-profile-dropdown,
        .header-right .offcanvas {
            width: calc(100vw - 20px) !important;
            max-width: calc(100vw - 20px) !important;
        }

        .header-profile-card {
            padding: 12px;
            gap: 10px;
        }

        .header-profile-card__avatar {
            width: 48px;
            height: 48px;
            flex-basis: 48px;
        }

        .header-profile-card__content h6 {
            font-size: 16px;
        }

        .admin-sidebar-logo__text strong {
            font-size: 20px;
        }

        .admin-sidebar-logo__text small {
            font-size: 9px;
        }
    }
</style>
