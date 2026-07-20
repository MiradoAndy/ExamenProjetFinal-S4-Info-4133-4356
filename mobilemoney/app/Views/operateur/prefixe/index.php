<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-hash"></i> Préfixes</h1>
    <a href="/operateur/prefixes/create" class="btn-teal">
        <i class="bi bi-plus"></i> Ajouter
    </a>
</div>

<!-- Nos préfixes -->
<div class="card">
    <div class="card-header teal-header">
        <h5><i class="bi bi-building"></i> Notre opérateur</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Préfixe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($prefixes_internes)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center;color:var(--secondary-label);padding:32px;">
                            Aucun préfixe enregistré.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($prefixes_internes as $p): ?>
                        <tr>
                            <td style="color:var(--secondary-label);font-size:0.85rem;"><?= $p['id_prefixe'] ?></td>
                            <td>
                                <span class="badge-pill badge-teal" style="font-size:0.95rem;letter-spacing:1px;">
                                    <?= esc($p['valeur']) ?>
                                </span>
                            </td>
                            <td style="display:flex;gap:8px;align-items:center;">
                                <a href="/operateur/prefixes/edit/<?= $p['id_prefixe'] ?>" class="btn-teal btn-icon-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <a href="/operateur/prefixes/delete/<?= $p['id_prefixe'] ?>"
                                   class="btn-pink btn-icon-sm"
                                   onclick="return confirm('Supprimer ce préfixe ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Préfixes des autres opérateurs -->
<div class="card">
    <div class="card-header pink-header">
        <h5><i class="bi bi-diagram-3-fill"></i> Autres opérateurs</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Préfixe</th>
                    <th>Commission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($prefixes_externes)): ?>
                    <tr>
                        <td colspan="4" style="text-align:center;color:var(--secondary-label);padding:32px;">
                            Aucun préfixe externe enregistré.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($prefixes_externes as $p): ?>
                        <tr>
                            <td style="color:var(--secondary-label);font-size:0.85rem;"><?= $p['id_prefixe'] ?></td>
                            <td>
                                <span class="badge-pill badge-pink" style="font-size:0.95rem;letter-spacing:1px;">
                                    <?= esc($p['valeur']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-pill badge-cyan">
                                    <?= number_format((float) $p['pourcentage_commission'], 2) ?> %
                                </span>
                            </td>
                            <td style="display:flex;gap:8px;align-items:center;">
                                <a href="/operateur/prefixes/edit/<?= $p['id_prefixe'] ?>" class="btn-teal btn-icon-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <a href="/operateur/prefixes/delete/<?= $p['id_prefixe'] ?>"
                                   class="btn-pink btn-icon-sm"
                                   onclick="return confirm('Supprimer ce préfixe ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
