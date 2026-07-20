<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-table"></i> Barèmes de frais</h1>
    <a href="/operateur/baremes/create" class="btn-teal">
        <i class="bi bi-plus"></i> Ajouter
    </a>
</div>

<?php
$baremesParType = [];
foreach ($baremes as $bareme) {
    $baremesParType[$bareme['libelle']][] = $bareme;
}
?>

<?php if (empty($baremes)): ?>
    <div class="alert alert-danger">
        <i class="bi bi-info-circle"></i> Aucun barème enregistré.
    </div>
<?php else: ?>
    <?php foreach ($baremesParType as $type => $lignes): ?>
        <div class="card">
            <div class="card-header <?= $type === 'retrait' ? 'teal-header' : 'pink-header' ?>">
                <h5>
                    <i class="bi bi-currency-exchange"></i>
                    <?= ucfirst(esc($type)) ?>
                </h5>
            </div>
            <div class="card-body">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Min (Ar)</th>
                            <th>Max (Ar)</th>
                            <th>Frais (Ar)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lignes as $bareme): ?>
                            <tr>
                                <td><?= number_format((float) $bareme['montant_min'], 0, ',', ' ') ?></td>
                                <td><?= number_format((float) $bareme['montant_max'], 0, ',', ' ') ?></td>
                                <td>
                                    <span class="badge-pill badge-teal">
                                        <?= number_format((float) $bareme['frais'], 0, ',', ' ') ?> Ar
                                    </span>
                                </td>
                                <td style="display:flex;gap:8px;align-items:center;">
                                    <a href="/operateur/baremes/edit/<?= $bareme['id_bareme_frais'] ?>" class="btn-teal btn-icon-sm">
                                        <i class="bi bi-pencil"></i> Modifier
                                    </a>
                                    <a href="/operateur/baremes/delete/<?= $bareme['id_bareme_frais'] ?>"
                                       class="btn-pink btn-icon-sm"
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
<?php endif; ?>

<?= $this->endSection() ?>
