<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1>
        <i class="bi bi-hash"></i>
        <?= $prefixe ? 'Modifier le préfixe' : 'Ajouter un préfixe' ?>
    </h1>
</div>

<div style="max-width:440px;">
    <div class="card">
        <div class="card-body p-form">
            <?php $action = $prefixe
                ? '/operateur/prefixes/update/' . $prefixe['id_prefixe']
                : '/operateur/prefixes/store'; ?>

            <?= form_open($action) ?>

                <div class="mb-4">
                    <label class="form-label">Valeur du préfixe</label>
                    <input type="text"
                           name="valeur"
                           class="form-control"
                           placeholder="Ex: 033"
                           value="<?= esc($prefixe['valeur'] ?? '') ?>"
                           required>
                    <div class="form-text mt-2">3 chiffres uniquement — ex: 033, 037, 032</div>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn-teal">
                        <i class="bi bi-checkmark-circle"></i> Enregistrer
                    </button>
                    <a href="/operateur/prefixes" class="btn-ghost">
                        Annuler
                    </a>
                </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
