<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Campaign Hub') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
<div class="d-flex">
    <aside class="bg-dark text-white p-3" style="width:260px;min-height:100vh;">
        <h5 class="mb-4">Campaign Hub</h5>
        <nav class="nav flex-column gap-1">
            <a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-link text-white" href="{{ route('contacts.index') }}">Contacts</a>
            <a class="nav-link text-white" href="{{ route('campaigns.index') }}">Campaigns</a>
            <a class="nav-link text-white" href="{{ route('templates.index') }}">Templates</a>
            <a class="nav-link text-white" href="{{ route('reports.index') }}">Reports</a>
            <a class="nav-link text-white" href="{{ route('users.index') }}">Users</a>
            <a class="nav-link text-white" href="{{ route('roles.index') }}">Roles</a>
            <a class="nav-link text-white" href="{{ route('settings.mail') }}">SMTP</a>
            <a class="nav-link text-white" href="{{ route('activity-logs.index') }}">Activity</a>
            <a class="nav-link text-white" href="{{ route('notifications.index') }}">Notifications</a>
        </nav>
    </aside>
    <main class="flex-grow-1">
        <header class="bg-white border-bottom p-3 d-flex justify-content-between">
            <strong>@yield('title', 'Dashboard')</strong>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">Profile</a>
        </header>
        <section class="p-4">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @yield('content')
        </section>
    </main>
</div>
</body>
</html>
