<?php
// Libellés affichés selon le type d'opération demandé (depot, retrait ou transfert).
$titres = [
    'depot'     => 'Dépôt',
    'retrait'   => 'Retrait',
    'transfert' => 'Transfert',
];
$titre = $titres[$type] ?? 'Opération';
?>

<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<div class="carte">
    <h2><?= esc($titre) ?></h2>

    <?= form_open('/client/operation/' . $type) ?>
        <?php if ($type === 'transfert'): ?>
            <label for="numero_destinataire">Numéro du destinataire</label>
            <input
                type="text"
                id="numero_destinataire"
                name="numero_destinataire"
                placeholder="Ex: 0371111111"
                value="<?= esc(old('numero_destinataire')) ?>"
                required
            >
        <?php endif; ?>

        <label for="montant">Montant (Ar)</label>
        <input
            type="number"
            id="montant"
            name="montant"
            min="1"
            step="1"
            placeholder="Ex: 5000"
            value="<?= esc(old('montant')) ?>"
            required
            autofocus
        >

        <div style="margin-top: 20px;">
            <button type="submit">Valider le <?= esc(mb_strtolower($titre)) ?></button>
        </div>
    <?= form_close() ?>
</div>

<a class="bouton secondaire" href="/client/dashboard">Retour au tableau de bord</a>

<?= $this->endSection() ?>
