<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<div class="carte">
    <h2 style="margin-top: 0;">Historique des opérations</h2>

    <?php if (empty($historique)): ?>
        <p>Aucune opération n'a encore été effectuée.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Frais</th>
                    <th>Destinataire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historique as $operation): ?>
                    <tr>
                        <td><?= esc($operation['date']) ?></td>
                        <td class="type-<?= esc($operation['type_libelle']) ?>">
                            <?= esc(ucfirst($operation['type_libelle'])) ?>
                        </td>
                        <td><?= number_format((float) $operation['montant'], 0, ',', ' ') ?> Ar</td>
                        <td><?= number_format((float) $operation['frais'], 0, ',', ' ') ?> Ar</td>
                        <td><?= esc($operation['numero_destinataire'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<a class="bouton secondaire" href="/client/dashboard">Retour au tableau de bord</a>

<?= $this->endSection() ?>
