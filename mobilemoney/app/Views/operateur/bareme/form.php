<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<div class="page-header">
    <h1>
        <i class="bi bi-table"></i>
        <?= $bareme ? 'Modifier le barème' : 'Ajouter un barème' ?>
    </h1>
</div>

<div style="max-width:480px;">
    <div class="card">
        <div class="card-body p-form">
            <?php $action = $bareme
                ? '/operateur/baremes/update/' . $bareme['id_bareme_frais']
                : '/operateur/baremes/store'; ?>

            <?= form_open($action) ?>

                <div class="mb-4">
                    <label class="form-label">Type d'opération</label>
                    <select name="type_operation_id" class="form-select" required>
                        <option value="">— Choisir —</option>
                        <?php foreach ($types_operation as $type): ?>
                            <?php if ($type['libelle'] === 'depot') continue; ?>
                            <option value="<?= $type['id_type_operation'] ?>"
                                <?= isset($bareme) && $bareme['type_operation_id'] == $type['id_type_operation'] ? 'selected' : '' ?>>
                                <?= ucfirst(esc($type['libelle'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text mt-2">Le dépôt est gratuit — frais sur retrait et transfert uniquement.</div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Montant minimum (Ar)</label>
                    <input type="number" name="montant_min" class="form-control"
                           value="<?= esc($bareme['montant_min'] ?? '') ?>" min="0" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Montant maximum (Ar)</label>
                    <input type="number" name="montant_max" class="form-control"
                           value="<?= esc($bareme['montant_max'] ?? '') ?>" min="1" required>
                </div>

                <div class="mb-5">
                    <label class="form-label">Frais (Ar)</label>
                    <input type="number" name="frais" class="form-control"
                           value="<?= esc($bareme['frais'] ?? '') ?>" min="0" required>
                </div>

                <div style="display:flex;gap:10px;">
                    <button type="submit" class="btn-teal">
                        <i class="bi bi-check-circle"></i> Enregistrer
                    </button>
                    <a href="/operateur/baremes" class="btn-ghost">
                        Annuler
                    </a>
                </div>

            <?= form_close() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
