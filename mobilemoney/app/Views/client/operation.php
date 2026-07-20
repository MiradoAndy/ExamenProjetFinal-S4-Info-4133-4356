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

            <div id="destinataires-container">
                <label>Numéro destinataire <span class="num-badge">1</span></label>
                <div class="dest-row">
                    <input
                        type="text"
                        name="numero_destinataire[]"
                        placeholder="Ex: 0321234567"
                        value="<?= esc(old('numero_destinataire.0')) ?>"
                        required
                    >
                </div>
            </div>

            <button type="button" id="btn-ajouter" onclick="ajouterDestinataire()">
                <i class="bi bi-plus-circle"></i> Ajouter un destinataire
            </button>

            <div style="margin-top:18px;display:flex;align-items:center;gap:10px;">
                <input type="checkbox"
                       id="inclure_frais_retrait"
                       name="inclure_frais_retrait"
                       value="1"
                       style="width:18px;height:18px;accent-color:var(--navy);cursor:pointer;flex-shrink:0;">
                <label for="inclure_frais_retrait" style="margin:0;font-size:0.88rem;font-weight:500;color:var(--label);cursor:pointer;">
                    Inclure les frais de retrait du destinataire
                </label>
            </div>
            <p style="font-size:0.78rem;color:var(--secondary-label);margin-top:6px;margin-left:28px;">
                Le destinataire pourra retirer sans frais supplémentaires.
            </p>

        <?php endif; ?>

        <label for="montant">Montant<?= $type === 'transfert' ? ' total' : '' ?> (Ar)</label>
        <input
            type="number"
            id="montant"
            name="montant"
            min="1"
            step="1"
            placeholder="Ex: 5000"
            value="<?= esc(old('montant')) ?>"
            required
            <?= $type !== 'transfert' ? 'autofocus' : '' ?>
        >

        <?php if ($type === 'transfert'): ?>
            <p id="montant-info" style="font-size:0.78rem;color:var(--secondary-label);margin-top:6px;">
                Le montant sera divisé équitablement entre tous les destinataires.
            </p>
        <?php endif; ?>

        <button type="submit" class="bouton-submit <?= $type === 'transfert' ? 'rose' : '' ?>">
            Valider le <?= esc(mb_strtolower($titre)) ?>
        </button>

    <?= form_close() ?>
</div>

<?php if ($type === 'transfert'): ?>
<style>
    #btn-ajouter {
        margin-top: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: none;
        border: 1.5px dashed var(--navy);
        color: var(--navy);
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.2s;
    }
    #btn-ajouter:hover { background: rgba(16,49,115,0.06); }

    .dest-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 6px;
    }
    .dest-row input { flex: 1; margin-top: 0; }

    .btn-suppr {
        background: none;
        border: none;
        color: var(--pink);
        font-size: 1.1rem;
        cursor: pointer;
        padding: 4px 6px;
        border-radius: 8px;
        flex-shrink: 0;
        transition: background 0.2s;
    }
    .btn-suppr:hover { background: rgba(242,109,158,0.1); }

    #destinataires-container label { margin-top: 14px; }
    #destinataires-container label:first-child { margin-top: 0; }
</style>
<script>
    let nbDest = 1;

    function ajouterDestinataire() {
        nbDest++;
        const container = document.getElementById('destinataires-container');

        const label = document.createElement('label');
        label.innerHTML = 'Numéro destinataire <span class="num-badge">' + nbDest + '</span>';

        const row = document.createElement('div');
        row.className = 'dest-row';

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'numero_destinataire[]';
        input.placeholder = 'Ex: 0321234567';
        input.required = true;

        const btnSuppr = document.createElement('button');
        btnSuppr.type = 'button';
        btnSuppr.className = 'btn-suppr';
        btnSuppr.innerHTML = '<i class="bi bi-x-circle-fill"></i>';
        btnSuppr.onclick = function () {
            label.remove();
            row.remove();
            majNumerotation();
        };

        row.appendChild(input);
        row.appendChild(btnSuppr);
        container.appendChild(label);
        container.appendChild(row);
        input.focus();
    }

    function majNumerotation() {
        const badges = document.querySelectorAll('#destinataires-container .num-badge');
        badges.forEach((badge, i) => { badge.textContent = i + 1; });
        nbDest = badges.length;
    }
</script>
<?php endif; ?>

<?= $this->endSection() ?>
