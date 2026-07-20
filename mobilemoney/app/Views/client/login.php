<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<div class="carte">
    <h2>Connexion</h2>
    <p style="color:var(--secondary-label);font-size:0.9rem;margin-top:6px;line-height:1.5;">
        Entrez votre numéro de téléphone pour accéder à votre compte. Aucune inscription préalable n'est nécessaire.
    </p>

    <?= form_open('/login') ?>
        <label for="numero">Numéro de téléphone</label>
        <input
            type="text"
            id="numero"
            name="numero"
            placeholder="Ex: 0331234567"
            value="<?= esc(old('numero')) ?>"
            minlength="10"
            maxlength="10"
            pattern="\d{10}"
            required
            autofocus
        >

        <button type="submit" class="bouton-submit">
            <i class="bi bi-arrow-right-circle-fill"></i> Se connecter
        </button>
    <?= form_close() ?>
</div>

<div style="margin-top:12px;text-align:center;">
    <a href="/operateur/prefixes" style="color:var(--secondary-label);font-size:0.85rem;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
        <i class="bi bi-cpu"></i> Espace opérateur
    </a>
</div>

<?= $this->endSection() ?>
