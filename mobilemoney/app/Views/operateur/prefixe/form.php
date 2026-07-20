<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1>
        <i class="bi bi-hash"></i>
        <?= $prefixe ? 'Modifier le préfixe' : 'Ajouter un préfixe' ?>
    </h1>
</div>

<div style="max-width:480px;">
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
                           placeholder="Ex: 032"
                           value="<?= esc($prefixe['valeur'] ?? '') ?>"
                           maxlength="3"
                           required>
                    <div class="form-text mt-2">3 chiffres — ex: 033, 037, 032, 031</div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Type</label>
                    <div style="display:flex;align-items:center;gap:10px;margin-top:8px;">
                        <input type="checkbox"
                               id="est_externe"
                               name="est_externe"
                               value="1"
                               <?= !empty($prefixe['est_externe']) ? 'checked' : '' ?>
                               style="width:18px;height:18px;accent-color:var(--pink);cursor:pointer;">
                        <label for="est_externe" style="margin:0;font-weight:600;font-size:0.9rem;color:var(--label);cursor:pointer;">
                            Préfixe d'un autre opérateur
                        </label>
                    </div>
                </div>

                <div class="mb-4" id="commission-field" style="display:<?= !empty($prefixe['est_externe']) ? 'block' : 'none' ?>;">
                    <label class="form-label">Commission inter-opérateur (%)</label>
                    <input type="number"
                           name="pourcentage_commission"
                           class="form-control"
                           placeholder="Ex: 5"
                           min="0"
                           max="100"
                           step="0.01"
                           value="<?= esc($prefixe['pourcentage_commission'] ?? '0') ?>">
                    <div class="form-text mt-2">% prélevé en supplément sur chaque transfert vers ce préfixe</div>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn-teal">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="/operateur/prefixes" class="btn-ghost">
                        Annuler
                    </a>
                </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
document.getElementById('est_externe').addEventListener('change', function () {
    document.getElementById('commission-field').style.display = this.checked ? 'block' : 'none';
});
</script>

<?= $this->endSection() ?>
