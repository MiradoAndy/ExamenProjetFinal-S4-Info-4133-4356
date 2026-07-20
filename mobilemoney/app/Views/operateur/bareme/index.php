<?php $title = 'Barèmes de frais'; ?>
<?= view('layout/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-table"></i> Barèmes de frais</h2>
    <a href="/operateur/baremes/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter un barème
    </a>
</div>

<?php
// Grouper les barèmes par type d'opération
$baremesParType = [];
foreach ($baremes as $bareme) {
    $baremesParType[$bareme['libelle']][] = $bareme;
}
?>

<?php foreach ($baremesParType as $type => $lignes): ?>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-capitalize"><i class="bi bi-currency-exchange"></i> <?= esc($type) ?></h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Montant min (Ar)</th>
                        <th>Montant max (Ar)</th>
                        <th>Frais (Ar)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignes as $bareme): ?>
                        <tr>
                            <td><?= number_format($bareme['montant_min'], 0, ',', ' ') ?></td>
                            <td><?= number_format($bareme['montant_max'], 0, ',', ' ') ?></td>
                            <td><strong><?= number_format($bareme['frais'], 0, ',', ' ') ?></strong></td>
                            <td>
                                <a href="/operateur/baremes/edit/<?= $bareme['id_bareme_frais'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                                <a href="/operateur/baremes/delete/<?= $bareme['id_bareme_frais'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Supprimer ce barème ?')">
                                    <i class="bi bi-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endforeach; ?>

<?php if (empty($baremes)): ?>
    <div class="alert alert-info">Aucun barème enregistré.</div>
<?php endif; ?>

<?= view('layout/footer') ?>
