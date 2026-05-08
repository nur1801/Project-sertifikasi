<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Frozeria')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --frozeria-navy: #0f172a;
            --frozeria-ice: #e0f2fe;
            --frozeria-sky: #0284c7;
            --frozeria-teal: #0f766e;
            --frozeria-amber: #d97706;
            --frozeria-rose: #be123c;
        }

        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(2, 132, 199, 0.12), transparent 24%),
                radial-gradient(circle at top right, rgba(15, 118, 110, 0.10), transparent 20%),
                #f8fafc;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: .4px;
        }

        .frozeria-shell {
            min-height: calc(100vh - 72px);
        }

        .card-soft {
            border: 0;
            box-shadow: 0 12px 35px rgba(15, 23, 42, .08);
            border-radius: 1rem;
        }

        .hero-panel {
            background: linear-gradient(135deg, #0f172a, #0f766e 70%, #0284c7);
            color: #fff;
            border-radius: 1.25rem;
            overflow: hidden;
            position: relative;
        }

        .hero-panel::after {
            content: '';
            position: absolute;
            inset: auto -40px -40px auto;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,.10);
            filter: blur(6px);
        }

        .hero-stat {
            background: rgba(255,255,255,.10);
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 1rem;
            backdrop-filter: blur(10px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
        }

        .page-title {
            font-weight: 800;
            color: var(--frozeria-navy);
            letter-spacing: -.03em;
        }

        .table thead th {
            text-transform: uppercase;
            font-size: .75rem;
            letter-spacing: .05em;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .table > :not(caption) > * > * {
            vertical-align: middle;
        }

        .badge-soft-primary { background: var(--frozeria-ice); color: var(--frozeria-sky); }
        .badge-soft-warning { background: #ffedd5; color: var(--frozeria-amber); }
        .badge-soft-danger { background: #ffe4e6; color: var(--frozeria-rose); }

        .action-links .btn {
            min-width: 84px;
        }

        .object-fit-cover {
            object-fit: cover;
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background: var(--frozeria-navy);">
    <div class="container py-2">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Frozeria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-semibold' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active fw-semibold' : '' }}" href="{{ route('categories.index') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('help') ? 'active fw-semibold' : '' }}" href="{{ route('help') }}">Bantuan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="frozeria-shell py-4 py-lg-5">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show card-soft" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger card-soft">
                <strong>Terjadi kesalahan validasi.</strong>
                <ul class="mb-0 mt-2 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>