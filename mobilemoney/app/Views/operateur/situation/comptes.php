<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-people-fill"></i> Comptes clients</h1>
</div>

<?php if (empty($clients)): ?>
    <div class="alert alert-danger">
        <i class="bi bi-info-circle"></i> Aucun client enregistré.
    </div>
<?php else: ?>
    <?php foreach ($clients as $client): ?>
        <div class="card">
            <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
                <h5>
                    <i class="bi bi-person-circle"></i>
                    <span style="font-size:1rem;letter-spacing:1px;"><?= esc($client['numero']) ?></span>
                </h5>
                <span class="solde-tag">
                    <?= number_format((float) $client['solde'], 0, ',', ' ') ?> Ar
                </span>
            </div>
            <div class="card-body">
                <?php if (empty($client['operations'])): ?>
                    <p style="color:var(--secondary-label);text-align:center;padding:24px 0;font-size:0.9rem;">
                        Aucune opération.
                    </p>
                <?php else: ?>
                    <table class="table mb-0">
                        <thead>
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
                                    <td style="color:var(--secondary-label);font-size:0.85rem;"><?= esc($op['date']) ?></td>
                                    <td>
                                        <span class="badge-pill
                                            <?= $op['libelle'] === 'depot'
                                                ? 'badge-teal'
                                                : ($op['libelle'] === 'retrait' ? 'badge-pink' : 'badge-cyan') ?>">
                                            <?= ucfirst(esc($op['libelle'])) ?>
                                        </span>
                                    </td>
                                    <td><?= number_format((float) $op['montant'], 0, ',', ' ') ?></td>
                                    <td><?= number_format((float) $op['frais'], 0, ',', ' ') ?></td>
                                    <td style="color:var(--secondary-label);">
                                        <?= esc($op['numero_destinataire'] ?? '—') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
