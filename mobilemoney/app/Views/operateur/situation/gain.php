<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-graph-up-arrow"></i> Situation des gains</h1>
</div>

<div class="total-card">
    <div class="t-label">Gain total collecté</div>
    <div class="t-amount">
        <?= number_format((float) $total_gains, 0, ',', ' ') ?>
        <span> Ar</span>
    </div>
</div>

<div class="card">
    <div class="card-header teal-header">
        <h5><i class="bi bi-pie-chart-fill"></i> Par type d'opération</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Nb opérations</th>
                    <th>Total frais (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($gains_par_type)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center;color:var(--secondary-label);padding:32px;">
                            Aucune opération enregistrée.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($gains_par_type as $gain): ?>
                        <tr>
                            <td>
                                <span class="badge-pill <?= $gain['libelle'] === 'retrait' ? 'badge-teal' : 'badge-pink' ?>">
                                    <?= ucfirst(esc($gain['libelle'])) ?>
                                </span>
                            </td>
                            <td><?= $gain['nb_operations'] ?></td>
                            <td><strong style="color:var(--teal);"><?= number_format((float) $gain['total_frais'], 0, ',', ' ') ?> Ar</strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-list-ul"></i> Historique détaillé</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Montant (Ar)</th>
                    <th>Frais (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historique_gains)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;color:var(--secondary-label);padding:32px;">
                            Aucune opération enregistrée.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($historique_gains as $h): ?>
                        <tr>
                            <td style="color:var(--secondary-label);font-size:0.85rem;"><?= $h['id_operation'] ?></td>
                            <td style="color:var(--secondary-label);font-size:0.85rem;"><?= esc($h['date']) ?></td>
                            <td><strong><?= esc($h['numero']) ?></strong></td>
                            <td>
                                <span class="badge-pill <?= $h['libelle'] === 'retrait' ? 'badge-teal' : 'badge-pink' ?>">
                                    <?= ucfirst(esc($h['libelle'])) ?>
                                </span>
                            </td>
                            <td><?= number_format((float) $h['montant'], 0, ',', ' ') ?></td>
                            <td><strong style="color:var(--pink);"><?= number_format((float) $h['frais'], 0, ',', ' ') ?> Ar</strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
