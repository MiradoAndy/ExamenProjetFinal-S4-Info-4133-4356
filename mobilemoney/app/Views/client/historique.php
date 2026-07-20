<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<a href="/client/dashboard" class="lien-retour">
    <i class="bi bi-chevron-left"></i> Retour
</a>

<div class="carte">
    <h2>Historique</h2>

    <?php if (empty($historique)): ?>
        <p style="color:var(--secondary-label);margin-top:12px;font-size:0.9rem;">
            Aucune opération n'a encore été effectuée.
        </p>
    <?php else: ?>
        <div style="margin-top:16px;overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Frais</th>
                        <th>Commission</th>
                        <th>Destinataire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historique as $operation): ?>
                        <tr>
                            <td style="color:var(--secondary-label);font-size:0.82rem;"><?= esc($operation['date']) ?></td>
                            <td class="type-<?= esc($operation['type_libelle']) ?>">
                                <?= esc(ucfirst($operation['type_libelle'])) ?>
                            </td>
                            <td><?= number_format((float) $operation['montant'], 0, ',', ' ') ?> Ar</td>
                            <td><?= number_format((float) $operation['frais'], 0, ',', ' ') ?> Ar</td>
                            <td>
                                <?php if ((float) ($operation['frais_commission'] ?? 0) > 0): ?>
                                    <span style="color:var(--pink);font-weight:600;">
                                        <?= number_format((float) $operation['frais_commission'], 0, ',', ' ') ?> Ar
                                    </span>
                                <?php else: ?>
                                    <span style="color:var(--secondary-label);">—</span>
                                <?php endif; ?>
                            </td>
                            <td style="color:var(--secondary-label);">
                                <?= esc($operation['numero_destinataire'] ?? '—') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
