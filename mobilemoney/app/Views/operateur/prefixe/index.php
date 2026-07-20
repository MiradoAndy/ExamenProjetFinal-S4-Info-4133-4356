<?php $title = 'Préfixes'; ?>
<?= view('layout/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-hash"></i> Préfixes valables</h2>
    <a href="/operateur/prefixes/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter un préfixe
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Préfixe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($prefixes)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Aucun préfixe enregistré.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($prefixes as $prefixe): ?>
                        <tr>
                            <td><?= $prefixe['id_prefixe'] ?></td>
                            <td><strong><?= esc($prefixe['valeur']) ?></strong></td>
                            <td>
                                <a href="/operateur/prefixes/edit/<?= $prefixe['id_prefixe'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <a href="/operateur/prefixes/delete/<?= $prefixe['id_prefixe'] ?>"
                                   class="btn btn-sm btn-danger"
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

<?= view('layout/footer') ?>
