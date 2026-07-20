<?php
$titres = [
    'depot'     => 'Dépôt',
    'retrait'   => 'Retrait',
    'transfert' => 'Transfert',
];
$titre = $titres[$type] ?? 'Opération';
?>

<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<a href="/client/dashboard" class="lien-retour">
    <i class="bi bi-chevron-left"></i> Retour
</a>

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

        <button type="submit" class="bouton-submit <?= $type === 'transfert' ? 'rose' : '' ?>">
            Valider le <?= esc(mb_strtolower($titre)) ?>
        </button>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
