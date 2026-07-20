<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<div class="carte">
    <div>Numéro de compte</div>
    <strong><?= esc($client['numero']) ?></strong>

    <div style="margin-top: 16px;">Solde disponible</div>
    <div class="solde"><?= number_format((float) $client['solde'], 0, ',', ' ') ?> Ar</div>
</div>

<div class="carte">
    <h3 style="margin-top: 0;">Opérations</h3>
    <div class="grille-operations">
        <a class="bouton" href="/client/operation/depot">Dépôt</a>
        <a class="bouton" href="/client/operation/retrait">Retrait</a>
        <a class="bouton" href="/client/operation/transfert">Transfert</a>
    </div>
</div>

<a class="bouton secondaire" href="/client/historique">Voir l'historique des opérations</a>

<?= $this->endSection() ?>
