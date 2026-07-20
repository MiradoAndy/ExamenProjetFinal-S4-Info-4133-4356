<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-hash"></i> Préfixes</h1>
    <a href="/operateur/prefixes/create" class="btn-teal">
        <i class="bi bi-plus"></i> Ajouter
    </a>
</div>

<div class="card">
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
                <?php if (empty($prefixes)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center;color:var(--secondary-label);padding:32px;">
                            Aucun préfixe enregistré.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($prefixes as $prefixe): ?>
                        <tr>
                            <td style="color:var(--secondary-label);font-size:0.85rem;"><?= $prefixe['id_prefixe'] ?></td>
                            <td>
                                <span class="badge-pill badge-teal" style="font-size:0.95rem;letter-spacing:1px;">
                                    <?= esc($prefixe['valeur']) ?>
                                </span>
                            </td>
                            <td style="display:flex;gap:8px;align-items:center;">
                                <a href="/operateur/prefixes/edit/<?= $prefixe['id_prefixe'] ?>" class="btn-teal btn-icon-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <a href="/operateur/prefixes/delete/<?= $prefixe['id_prefixe'] ?>"
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
