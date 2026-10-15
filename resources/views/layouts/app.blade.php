<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'StudentDesk') · StudentDesk</title>
    <link rel="stylesheet" href="{{ asset('css/studentdesk.css') }}">
</head>
<body>
<div class="app-shell">
    <aside class="sidebar">
        <a class="brand" href="{{ route('dashboard') }}">
            <span class="brand-mark">S</span>
            <span>Student<span class="brand-light">Desk</span></span>
        </a>
        <div class="side-label">WORKSPACE</div>
        <nav class="nav-menu">
            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <span class="nav-icon">⌂</span> Overview
            </a>
            <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                <span class="nav-icon">▤</span> Students
            </a>
        </nav>
        <div class="sidebar-bottom">
            <div class="help-card">
                <div class="help-icon">✦</div>
                <strong>Learning project</strong>
                <p>A clean Laravel CRUD app to explore, debug and extend.</p>
            </div>
            <div class="profile-row">
                <div class="avatar avatar-purple">SR</div>
                <div><strong>Developer</strong><small>Workspace</small></div>
            </div>
        </div>
    </aside>

    <main class="main-panel">
        <header class="topbar">
            <div class="mobile-brand"><span class="brand-mark">S</span> StudentDesk</div>
            <div class="breadcrumb">Workspace <span>/</span> @yield('breadcrumb', 'Overview')</div>
            <div class="topbar-right"><span class="status-dot"></span><span>Local environment</span><span class="top-avatar">SR</span></div>
        </header>
        <section class="page-content">
            @if (session('success'))
                <div class="alert-success"><span>✓</span> {{ session('success') }} <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button></div>
            @endif
            @if ($errors->any())
                <div class="alert-error">
                    <strong>Please check the form:</strong>
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            @yield('content')
            <footer class="footer">StudentDesk <span>·</span> Built with Laravel and Eloquent <span class="footer-right">Learning project</span></footer>
        </section>
    </main>
</div>
</body>
</html>
