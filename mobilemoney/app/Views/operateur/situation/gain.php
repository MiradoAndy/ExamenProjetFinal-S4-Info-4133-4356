<?php $title = 'Situation des gains'; ?>
<?= view('layout/header') ?>

<h2 class="mb-4"><i class="bi bi-graph-up-arrow"></i> Situation des gains</h2>

<!-- Total général -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body text-center">
                <h6 class="card-title">GAIN TOTAL</h6>
                <h2 class="card-text"><?= number_format($total_gains, 0, ',', ' ') ?> Ar</h2>
            </div>
        </div>
    </div>
</div>

<!-- Gains par type d'opération -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Gains par type d'opération</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Type d'opération</th>
                    <th>Nombre d'opérations</th>
                    <th>Total frais collectés (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($gains_par_type)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">Aucune opération enregistrée.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($gains_par_type as $gain): ?>
                        <tr>
                            <td class="text-capitalize"><strong><?= esc($gain['libelle']) ?></strong></td>
                            <td><?= $gain['nb_operations'] ?></td>
                            <td><?= number_format($gain['total_frais'], 0, ',', ' ') ?> Ar</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Historique détaillé des gains -->
<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Historique des gains</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Montant (Ar)</th>
                    <th>Frais collectés (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historique_gains)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucune opération enregistrée.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($historique_gains as $h): ?>
                        <tr>
                            <td><?= $h['id_operation'] ?></td>
                            <td><?= $h['date'] ?></td>
                            <td><?= esc($h['numero']) ?></td>
                            <td class="text-capitalize"><?= esc($h['libelle']) ?></td>
                            <td><?= number_format($h['montant'], 0, ',', ' ') ?></td>
                            <td><strong class="text-success"><?= number_format($h['frais'], 0, ',', ' ') ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('layout/footer') ?>
