<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-graph-up-arrow"></i> Situation des gains</h1>
</div>

<!-- Résumé : nos gains + commissions à reverser -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px;">
    <div class="total-card">
        <div class="t-label"><i class="bi bi-building"></i> Nos gains (barème)</div>
        <div class="t-amount">
            <?= number_format((float) $total_gains, 0, ',', ' ') ?>
            <span> Ar</span>
        </div>
    </div>
    <div class="total-card" style="background-color:var(--pink);">
        <div class="t-label" style="color:rgba(255,255,255,0.8);"><i class="bi bi-diagram-3-fill"></i> Commissions inter-op (à reverser)</div>
        <div class="t-amount">
            <?= number_format((float) $total_commissions, 0, ',', ' ') ?>
            <span> Ar</span>
        </div>
    </div>
</div>

<!-- Par type d'opération -->
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
                    <th>Frais barème (Ar)</th>
                    <th>Commission inter-op (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($gains_par_type)): ?>
                    <tr>
                        <td colspan="4" style="text-align:center;color:var(--secondary-label);padding:32px;">
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
                            <td><strong style="color:var(--navy);"><?= number_format((float) $gain['total_frais'], 0, ',', ' ') ?> Ar</strong></td>
                            <td>
                                <?php if ((float) $gain['total_commission'] > 0): ?>
                                    <strong style="color:var(--pink);"><?= number_format((float) $gain['total_commission'], 0, ',', ' ') ?> Ar</strong>
                                <?php else: ?>
                                    <span style="color:var(--secondary-label);">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Historique détaillé -->
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
                    <th>Frais barème (Ar)</th>
                    <th>Commission (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($historique_gains)): ?>
                    <tr>
                        <td colspan="7" style="text-align:center;color:var(--secondary-label);padding:32px;">
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
                                <?php if (!empty($h['numero_destinataire'])): ?>
                                    <span style="font-size:0.75rem;color:var(--secondary-label);margin-left:4px;">
                                        → <?= esc($h['numero_destinataire']) ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?= number_format((float) $h['montant'], 0, ',', ' ') ?></td>
                            <td><strong style="color:var(--navy);"><?= number_format((float) $h['frais'], 0, ',', ' ') ?> Ar</strong></td>
                            <td>
                                <?php if ((float) $h['frais_commission'] > 0): ?>
                                    <strong style="color:var(--pink);"><?= number_format((float) $h['frais_commission'], 0, ',', ' ') ?> Ar</strong>
                                <?php else: ?>
                                    <span style="color:var(--secondary-label);">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
