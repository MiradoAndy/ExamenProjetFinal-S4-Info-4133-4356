<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Money – Opérateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        *, *::before, *::after { box-sizing: border-box; }

        :root {
            --navy:   #103173;
            --pink:   #F26D9E;
            --yellow: #F2B705;
            --orange: #F27507;
            --lpink:  #F2B3CA;
            --surface:#FFFFFF;
            --label:  #1C1C1E;
            --secondary-label: #6E6E73;
            --separator: rgba(60,60,67,0.12);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #FFFFFF;
            color: var(--label);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── NAVBAR ─────────────────────────────── */
        .navbar {
            background: var(--navy) !important;
            border-bottom: 5px solid var(--pink);
            padding: 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .container { padding: 12px 24px; }
        .navbar-brand {
            font-weight: 700;
            font-size: 1rem;
            color: #fff !important;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand i { font-size: 1.2rem; color: var(--yellow); }
        .nav-link {
            color: rgba(255,255,255,0.88) !important;
            font-weight: 500;
            font-size: 0.87rem;
            padding: 7px 14px !important;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .nav-link:hover { background: rgba(255,255,255,0.15); color: #fff !important; }

        /* ── MAIN CONTENT ───────────────────────── */
        .main-content {
            position: relative;
            z-index: 1;
            max-width: 960px;
            margin: 0 auto;
            padding: 32px 20px 64px;
        }

        /* ── PAGE HEADER ─────────────────────────── */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }
        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -0.5px;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            text-shadow: 0 1px 3px rgba(255,255,255,0.8);
        }
        .page-header h1 i { color: var(--navy); }

        /* ── CARDS ───────────────────────────────── */
        .card {
            background: rgba(255,255,255,0.96) !important;
            border: none !important;
            border-radius: 18px !important;
            box-shadow: 0 4px 24px rgba(16,49,115,0.15);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .card-header {
            border-radius: 0 !important;
            border-bottom: none !important;
            padding: 16px 20px;
            background: var(--navy) !important;
        }
        .card-header h5 {
            font-weight: 600;
            font-size: 0.95rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #fff;
        }
        .card-header h5 i { color: var(--yellow); }
        .card-body { padding: 0; }
        .card-body.p-form { padding: 24px; }

        .card-header.teal-header  { background: var(--navy) !important; }
        .card-header.teal-header h5 { color: #fff; }
        .card-header.teal-header h5 i { color: var(--yellow); }

        .card-header.pink-header  { background: var(--pink) !important; }
        .card-header.pink-header h5 { color: #fff; }
        .card-header.pink-header h5 i { color: rgba(255,255,255,0.85); }

        /* ── TOTAL CARD ──────────────────────────── */
        .total-card {
            background-color: var(--navy);
            border-radius: 18px;
            padding: 28px 32px;
            margin-bottom: 20px;
            box-shadow: 0 4px 24px rgba(16,49,115,0.25);
        }
        .total-card .t-label {
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--yellow);
            margin-bottom: 6px;
        }
        .total-card .t-amount {
            font-size: 2.8rem;
            font-weight: 700;
            color: #FFFFFF;
            letter-spacing: -1px;
            line-height: 1;
        }
        .total-card .t-amount span { font-size: 1.3rem; font-weight: 500; opacity: 0.8; }

        /* ── BUTTONS ─────────────────────────────── */
        .btn-teal {
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.87rem;
            padding: 10px 22px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 2px 10px rgba(16,49,115,0.3);
        }
        .btn-teal:hover { opacity: 0.88; transform: scale(1.02); color: #fff; }

        .btn-pink {
            background: var(--pink);
            color: #fff;
            border: none;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.87rem;
            padding: 10px 22px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 2px 10px rgba(242,109,158,0.3);
        }
        .btn-pink:hover { opacity: 0.88; transform: scale(1.02); color: #fff; }

        .btn-ghost {
            background: rgba(0,0,0,0.06);
            color: var(--label);
            border: none;
            border-radius: 24px;
            font-weight: 600;
            font-size: 0.87rem;
            padding: 10px 22px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-ghost:hover { background: rgba(0,0,0,0.1); color: var(--label); }

        .btn-icon-sm { padding: 6px 14px; font-size: 0.8rem; border-radius: 16px; }

        /* ── TABLE ───────────────────────────────── */
        .table { margin: 0; }
        .table thead th {
            background: var(--navy);
            color: #fff;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 12px 20px;
        }
        .table tbody td {
            border: none;
            border-top: 1px solid var(--separator);
            padding: 14px 20px;
            font-size: 0.9rem;
            color: var(--label);
        }
        .table tbody tr:hover td { background: rgba(16,49,115,0.04); }

        /* ── BADGES ──────────────────────────────── */
        .badge-pill {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .badge-teal   { background: rgba(16,49,115,0.12);  color: var(--navy); }
        .badge-pink   { background: rgba(242,109,158,0.15); color: var(--pink); }
        .badge-cyan   { background: rgba(242,183,5,0.2);    color: #8a6800; }
        .badge-orange { background: rgba(242,117,7,0.12);   color: var(--orange); }

        .solde-tag {
            background: rgba(16,49,115,0.12);
            color: var(--navy);
            font-weight: 700;
            font-size: 0.9rem;
            padding: 6px 16px;
            border-radius: 20px;
        }

        /* ── ALERTS ──────────────────────────────── */
        .alert {
            border: none !important;
            border-radius: 14px !important;
            font-size: 0.9rem;
            font-weight: 600;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success {
            background: var(--yellow) !important;
            color: var(--navy) !important;
        }
        .alert-danger {
            background: var(--pink) !important;
            color: #fff !important;
        }

        /* ── FORM ────────────────────────────────── */
        .form-label {
            font-weight: 600;
            font-size: 0.83rem;
            color: var(--secondary-label);
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            border: 1.5px solid var(--separator) !important;
            border-radius: 12px !important;
            padding: 11px 14px !important;
            font-family: 'Inter', sans-serif;
            font-size: 0.93rem;
            background: #fff !important;
            color: var(--label);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--navy) !important;
            box-shadow: 0 0 0 3px rgba(16,49,115,0.15) !important;
            background: #fff !important;
        }
        .form-text { font-size: 0.78rem; color: var(--secondary-label); margin-top: 5px; }

        /* ── SECTION HEADER ──────────────────────── */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--navy);
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/operateur/prefixes">
            <i class="bi bi-cpu-fill"></i> Opérateur
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link" href="/operateur/prefixes">
                        <i class="bi bi-hash"></i> Préfixes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/operateur/baremes">
                        <i class="bi bi-table"></i> Barèmes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/operateur/situation/gain">
                        <i class="bi bi-graph-up-arrow"></i> Gains
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/operateur/situation/comptes">
                        <i class="bi bi-people-fill"></i> Comptes
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="/login">
                        <i class="bi bi-person-circle"></i> Espace client
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="main-content">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success mb-4">
            <i class="bi bi-check-circle-fill"></i>
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mb-4">
            <i class="bi bi-exclamation-circle-fill"></i>
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <?= $this->renderSection('contenu') ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
