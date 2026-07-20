<?php $title = $prefixe ? 'Modifier un préfixe' : 'Ajouter un préfixe'; ?>
<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-hash"></i> <?= $title ?></h5>
            </div>
            <div class="card-body">
                <?php $action = $prefixe ? '/operateur/prefixes/update/' . $prefixe['id_prefixe'] : '/operateur/prefixes/store'; ?>
                <form action="<?= $action ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Valeur du préfixe</label>
                        <input type="text"
                               name="valeur"
                               class="form-control"
                               placeholder="ex: 033"
                               value="<?= esc($prefixe['valeur'] ?? '') ?>"
                               required>
                        <div class="form-text">Entrez uniquement les chiffres du préfixe (ex: 033, 037)</div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Enregistrer
                        </button>
                        <a href="/operateur/prefixes" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
