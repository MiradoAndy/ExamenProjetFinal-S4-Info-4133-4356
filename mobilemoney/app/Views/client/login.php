<?= $this->extend('client/layout') ?>

<?= $this->section('contenu') ?>

<div class="carte">
    <h2>Connexion</h2>
    <p>Entrez votre numéro de téléphone pour accéder à votre compte. Aucune inscription préalable n'est nécessaire.</p>

    <?= form_open('/login') ?>
        <label for="numero">Numéro de téléphone</label>
        <input
            type="text"
            id="numero"
            name="numero"
            placeholder="Ex: 0331234567"
            value="<?= esc(old('numero')) ?>"
            required
            autofocus
        >

        <div style="margin-top: 20px;">
            <button type="submit">Se connecter</button>
        </div>
    <?= form_close() ?>
</div>

<?= $this->endSection() ?>
