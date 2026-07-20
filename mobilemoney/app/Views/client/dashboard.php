<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<div class="carte">
    <div class="label-compte">Numéro de compte</div>
    <strong style="font-size:1rem;letter-spacing:1px;"><?= esc($client['numero']) ?></strong>

    <div class="label-compte" style="margin-top:20px;">Solde disponible</div>
    <div class="solde"><?= number_format((float) $client['solde'], 0, ',', ' ') ?> <span>Ar</span></div>
</div>

<div class="carte">
    <h3>Opérations</h3>
    <div class="grille-operations">
        <a class="bouton" href="/client/operation/depot">
            <i class="bi bi-arrow-down-circle-fill"></i>
            Dépôt
        </a>
        <a class="bouton" href="/client/operation/retrait">
            <i class="bi bi-arrow-up-circle-fill"></i>
            Retrait
        </a>
        <a class="bouton secondaire" href="/client/operation/transfert">
            <i class="bi bi-send-fill"></i>
            Transfert
        </a>
    </div>
</div>

<a class="bouton secondaire" href="/client/historique" style="display:flex;justify-content:center;gap:8px;">
    <i class="bi bi-clock-history"></i> Voir l'historique
</a>

<?= $this->endSection() ?>
