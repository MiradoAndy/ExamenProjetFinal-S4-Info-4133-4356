<?= $this->extend('operateur/layout') ?>

<?= $this->section('contenu') ?>

<style>
    .pag-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        border-top: 1px solid var(--separator);
        background: rgba(16,49,115,0.03);
    }
    .pag-info {
        font-size: 0.82rem;
        font-weight: 600;
        color: var(--secondary-label);
    }
    .pag-btns { display: flex; gap: 6px; }
    .pag-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: var(--navy);
        color: #fff;
        border: none;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        padding: 5px 14px;
        cursor: pointer;
        transition: opacity 0.2s;
    }
    .pag-btn:disabled { opacity: 0.3; cursor: default; }
    .pag-btn:not(:disabled):hover { opacity: 0.85; }
</style>

<div class="page-header">
    <h1><i class="bi bi-people-fill"></i> Comptes clients</h1>
</div>

<?php if (empty($clients)): ?>
    <div class="alert alert-danger">
        <i class="bi bi-info-circle"></i> Aucun client enregistré.
    </div>
<?php else: ?>
    <?php foreach ($clients as $client): ?>
        <?php
            $cid   = (int) $client['id_client'];
            $ops   = $client['operations'];
            $total = count($ops);
            $pages = (int) ceil($total / 3);
        ?>
        <div class="card">
            <div class="card-header" style="display:flex;justify-content:space-between;align-items:center;">
                <h5>
                    <i class="bi bi-person-circle"></i>
                    <span style="font-size:1rem;letter-spacing:1px;"><?= esc($client['numero']) ?></span>
                </h5>
                <span class="solde-tag">
                    <?= number_format((float) $client['solde'], 0, ',', ' ') ?> Ar
                </span>
            </div>
            <div class="card-body">
                <?php if (empty($ops)): ?>
                    <p style="color:var(--secondary-label);text-align:center;padding:24px 0;font-size:0.9rem;">
                        Aucune opération.
                    </p>
                <?php else: ?>
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Montant (Ar)</th>
                                <th>Frais (Ar)</th>
                                <th>Commission (Ar)</th>
                                <th>Destinataire</th>
                            </tr>
                        </thead>
                        <tbody id="ops-<?= $cid ?>">
                            <?php foreach ($ops as $i => $op): ?>
                                <tr class="op-row-<?= $cid ?>"
                                    data-idx="<?= $i ?>"
                                    style="<?= $i >= 3 ? 'display:none' : '' ?>">
                                    <td style="color:var(--secondary-label);font-size:0.85rem;"><?= esc($op['date']) ?></td>
                                    <td>
                                        <span class="badge-pill
                                            <?= $op['libelle'] === 'depot'
                                                ? 'badge-teal'
                                                : ($op['libelle'] === 'retrait' ? 'badge-pink' : 'badge-cyan') ?>">
                                            <?= ucfirst(esc($op['libelle'])) ?>
                                        </span>
                                    </td>
                                    <td><?= number_format((float) $op['montant'], 0, ',', ' ') ?></td>
                                    <td><?= number_format((float) $op['frais'], 0, ',', ' ') ?></td>
                                    <td>
                                        <?php if ((float) ($op['frais_commission'] ?? 0) > 0): ?>
                                            <strong style="color:var(--pink);">
                                                <?= number_format((float) $op['frais_commission'], 0, ',', ' ') ?>
                                            </strong>
                                        <?php else: ?>
                                            <span style="color:var(--secondary-label);">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="color:var(--secondary-label);">
                                        <?= esc($op['numero_destinataire'] ?? '—') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php if ($pages > 1): ?>
                        <div class="pag-bar">
                            <span class="pag-info" id="pag-info-<?= $cid ?>">
                                Page 1 / <?= $pages ?>
                            </span>
                            <div class="pag-btns">
                                <button class="pag-btn"
                                        id="prev-<?= $cid ?>"
                                        disabled
                                        onclick="changerPage(<?= $cid ?>, -1, <?= $total ?>)">
                                    <i class="bi bi-chevron-left"></i> Précédent
                                </button>
                                <button class="pag-btn"
                                        id="next-<?= $cid ?>"
                                        onclick="changerPage(<?= $cid ?>, 1, <?= $total ?>)">
                                    Suivant <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
const pageCourante = {};

function changerPage(cid, direction, total) {
    const perPage   = 3;
    const totalPages = Math.ceil(total / perPage);

    if (pageCourante[cid] === undefined) pageCourante[cid] = 0;
    pageCourante[cid] = Math.max(0, Math.min(totalPages - 1, pageCourante[cid] + direction));

    const page = pageCourante[cid];

    document.querySelectorAll('.op-row-' + cid).forEach(function (row) {
        const idx = parseInt(row.dataset.idx, 10);
        row.style.display = (idx >= page * perPage && idx < (page + 1) * perPage) ? '' : 'none';
    });

    document.getElementById('pag-info-' + cid).textContent = 'Page ' + (page + 1) + ' / ' + totalPages;
    document.getElementById('prev-' + cid).disabled = page === 0;
    document.getElementById('next-' + cid).disabled = page === totalPages - 1;
}
</script>

<?= $this->endSection() ?>
