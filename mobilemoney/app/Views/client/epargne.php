<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<a href="/client/dashboard" class="lien-retour">
    <i class="bi bi-chevron-left"></i> Retour
</a>

<!-- Solde épargne -->
<div class="carte">
    <div class="label-compte">Solde épargne</div>
    <div class="solde" style="color:var(--pink);">
        <?= number_format((float) ($client['solde_epargne'] ?? 0), 0, ',', ' ') ?> <span>Ar</span>
    </div>

    <div class="label-compte" style="margin-top:20px;">Taux d'épargne actuel</div>
    <div style="font-size:2rem;font-weight:700;color:var(--navy);margin-top:4px;">
        <?= (int) ($client['pourcentage_epargne'] ?? 0) ?> %
    </div>
    <p style="font-size:0.8rem;color:var(--secondary-label);margin-top:6px;">
        À chaque transfert reçu, ce pourcentage est automatiquement mis de côté dans votre épargne.
    </p>
</div>

<!-- Modifier le taux -->
<div class="carte">
    <h3>Modifier le taux d'épargne</h3>

    <?= form_open('/client/epargne') ?>

        <label for="pourcentage_epargne">Nouveau taux (%)</label>
        <input
            type="number"
            id="pourcentage_epargne"
            name="pourcentage_epargne"
            min="0"
            max="100"
            step="1"
            placeholder="Ex: 10"
            value="<?= (int) ($client['pourcentage_epargne'] ?? 0) ?>"
            required
            autofocus
        >
        <p style="font-size:0.78rem;color:var(--secondary-label);margin-top:6px;">Entre 0% et 100%</p>

        <button type="submit" class="bouton-submit">
            Enregistrer
        </button>

    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
