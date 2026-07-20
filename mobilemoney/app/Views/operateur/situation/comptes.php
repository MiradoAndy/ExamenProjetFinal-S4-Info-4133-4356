<?php $title = 'Situation des comptes clients'; ?>
<?= view('layout/header') ?>

<h2 class="mb-4"><i class="bi bi-people"></i> Situation des comptes clients</h2>

<?php if (empty($clients)): ?>
    <div class="alert alert-info">Aucun client enregistré.</div>
<?php else: ?>
    <?php foreach ($clients as $client): ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center bg-light">
                <div>
                    <i class="bi bi-person-circle"></i>
                    <strong><?= esc($client['numero']) ?></strong>
                </div>
                <span class="badge bg-success fs-6">
                    Solde : <?= number_format($client['solde'], 0, ',', ' ') ?> Ar
                </span>
            </div>
            <div class="card-body p-0">
                <?php if (empty($client['operations'])): ?>
                    <p class="text-muted text-center p-3 mb-0">Aucune opération.</p>
                <?php else: ?>
                    <table class="table table-sm table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Montant (Ar)</th>
                                <th>Frais (Ar)</th>
                                <th>Destinataire</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($client['operations'] as $op): ?>
                                <tr>
                                    <td><?= $op['date'] ?></td>
                                    <td class="text-capitalize"><?= esc($op['libelle']) ?></td>
                                    <td><?= number_format($op['montant'], 0, ',', ' ') ?></td>
                                    <td><?= number_format($op['frais'], 0, ',', ' ') ?></td>
                                    <td><?= esc($op['numero_destinataire'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= view('layout/footer') ?>
