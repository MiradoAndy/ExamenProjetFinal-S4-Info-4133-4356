<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1><i class="bi bi-diagram-3-fill"></i> Montants à envoyer aux opérateurs</h1>
    <a href="/operateur/situation/gain" class="btn-ghost btn-icon-sm">
        <i class="bi bi-chevron-left"></i> Gains
    </a>
</div>

<?php
$grand_total = array_sum(array_column($montants_par_operateur, 'total_a_envoyer'));
?>

<div class="total-card" style="background-color:var(--pink);">
    <div class="t-label"><i class="bi bi-send-fill"></i> Total à envoyer (tous opérateurs)</div>
    <div class="t-amount">
        <?= number_format((float) $grand_total, 0, ',', ' ') ?>
        <span> Ar</span>
    </div>
</div>

<div class="card">
    <div class="card-header pink-header">
        <h5><i class="bi bi-table"></i> Détail par opérateur</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Préfixe</th>
                    <th>Commission</th>
                    <th>Nb transferts</th>
                    <th>Montants transférés (Ar)</th>
                    <th>Commissions collectées (Ar)</th>
                    <th>Total à envoyer (Ar)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($montants_par_operateur)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;color:var(--secondary-label);padding:32px;">
                            Aucun transfert inter-opérateur enregistré.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($montants_par_operateur as $op): ?>
                        <tr>
                            <td>
                                <span class="badge-pill badge-pink" style="font-size:0.95rem;letter-spacing:1px;">
                                    <?= esc($op['valeur']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-pill badge-cyan">
                                    <?= number_format((float) $op['pourcentage_commission'], 2) ?> %
                                </span>
                            </td>
                            <td><?= $op['nb_transferts'] ?></td>
                            <td><?= number_format((float) $op['total_montant'], 0, ',', ' ') ?> Ar</td>
                            <td style="color:var(--pink);">+ <?= number_format((float) $op['total_commission'], 0, ',', ' ') ?> Ar</td>
                            <td>
                                <strong style="color:var(--navy);font-size:1rem;">
                                    <?= number_format((float) $op['total_a_envoyer'], 0, ',', ' ') ?> Ar
                                </strong>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
