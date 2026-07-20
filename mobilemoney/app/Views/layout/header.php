<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Money - <?= $title ?? 'Opérateur' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/"><i class="bi bi-phone"></i> Mobile Money</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-gear"></i> Opérateur
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/operateur/prefixes"><i class="bi bi-hash"></i> Préfixes</a></li>
                        <li><a class="dropdown-item" href="/operateur/baremes"><i class="bi bi-table"></i> Barèmes de frais</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/operateur/situation/gain"><i class="bi bi-graph-up-arrow"></i> Situation gain</a></li>
                        <li><a class="dropdown-item" href="/operateur/situation/comptes"><i class="bi bi-people"></i> Comptes clients</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/client/login"><i class="bi bi-person-circle"></i> Espace client</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
