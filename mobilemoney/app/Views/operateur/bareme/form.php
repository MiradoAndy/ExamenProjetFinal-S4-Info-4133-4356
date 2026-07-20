<?php $title = $bareme ? 'Modifier un barème' : 'Ajouter un barème'; ?>
<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-table"></i> <?= $title ?></h5>
            </div>
            <div class="card-body">
                <?php $action = $bareme ? '/operateur/baremes/update/' . $bareme['id_bareme_frais'] : '/operateur/baremes/store'; ?>
                <form action="<?= $action ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Type d'opération</label>
                        <select name="type_operation_id" class="form-select" required>
                            <option value="">-- Choisir --</option>
                            <?php foreach ($types_operation as $type): ?>
                                <?php if ($type['libelle'] === 'depot') continue; ?>
                                <option value="<?= $type['id_type_operation'] ?>"
                                    <?= isset($bareme) && $bareme['type_operation_id'] == $type['id_type_operation'] ? 'selected' : '' ?>>
                                    <?= ucfirst(esc($type['libelle'])) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text">Le dépôt est gratuit, les frais s'appliquent uniquement au retrait et au transfert.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Montant minimum (Ar)</label>
                        <input type="number"
                               name="montant_min"
                               class="form-control"
                               value="<?= esc($bareme['montant_min'] ?? '') ?>"
                               min="0" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Montant maximum (Ar)</label>
                        <input type="number"
                               name="montant_max"
                               class="form-control"
                               value="<?= esc($bareme['montant_max'] ?? '') ?>"
                               min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Frais (Ar)</label>
                        <input type="number"
                               name="frais"
                               class="form-control"
                               value="<?= esc($bareme['frais'] ?? '') ?>"
                               min="0" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                        <a href="/operateur/baremes" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
