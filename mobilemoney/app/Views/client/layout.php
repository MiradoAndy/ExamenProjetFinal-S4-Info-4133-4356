<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Money – <?= esc($titre ?? 'Espace client') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:   #103173;
            --pink:   #F26D9E;
            --yellow: #F2B705;
            --orange: #F27507;
            --lpink:  #F2B3CA;
            --surface:#FFFFFF;
            --label:  #1C1C1E;
            --secondary-label: #6E6E73;
            --separator: rgba(60,60,67,0.12);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #FFFFFF;
            color: var(--label);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ── HEADER ─────────────────────────────── */
        header {
            background: var(--navy);
            border-bottom: 5px solid var(--pink);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .header-inner {
            max-width: 560px;
            margin: 0 auto;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .brand {
            font-size: 1rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
            gap: 7px;
            text-decoration: none;
        }
        .brand i { font-size: 1.1rem; color: var(--yellow); }

        nav { display: flex; gap: 4px; }
        nav a {
            color: rgba(255,255,255,0.88);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 7px 13px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: background 0.2s;
        }
        nav a:hover { background: rgba(255,255,255,0.15); color: #fff; }
        nav a.nav-exit { color: rgba(255,255,255,0.75); }

        /* ── MAIN ───────────────────────────────── */
        main {
            position: relative;
            z-index: 1;
            max-width: 560px;
            margin: 0 auto;
            padding: 28px 20px 72px;
        }

        /* ── FLASH MESSAGES ─────────────────────── */
        .message {
            padding: 14px 18px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 16px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .message.erreur  { background: var(--pink);   color: #fff; }
        .message.succes  { background: var(--yellow);  color: var(--navy); }

        /* ── CARTE ──────────────────────────────── */
        .carte {
            background: rgba(255,255,255,0.96);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 4px 24px rgba(16,49,115,0.15);
        }

        .carte h2 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -1px;
            color: var(--label);
            margin-bottom: 4px;
        }
        .carte h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--label);
            margin-bottom: 16px;
        }

        /* ── SOLDE ──────────────────────────────── */
        .label-compte {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--secondary-label);
            margin-top: 4px;
        }
        .solde {
            font-size: 3rem;
            font-weight: 700;
            color: var(--navy);
            letter-spacing: -2px;
            line-height: 1;
            margin-top: 4px;
        }
        .solde span { font-size: 1.4rem; font-weight: 500; letter-spacing: 0; }

        /* ── GRILLE OPÉRATIONS ───────────────────── */
        .grille-operations {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        /* ── BOUTONS ─────────────────────────────── */
        .bouton {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 16px 10px;
            background: var(--navy);
            color: #fff;
            border-radius: 16px;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 2px 10px rgba(16,49,115,0.25);
        }
        .bouton i { font-size: 1.4rem; }
        .bouton:hover { opacity: 0.85; transform: scale(1.03); color: #fff; }

        .bouton.secondaire {
            background: var(--pink);
            box-shadow: 0 2px 10px rgba(242,109,158,0.25);
        }

        .bouton-submit {
            width: 100%;
            padding: 15px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: opacity 0.2s, transform 0.15s;
            box-shadow: 0 2px 12px rgba(16,49,115,0.3);
        }
        .bouton-submit:hover { opacity: 0.88; transform: translateY(-1px); }
        .bouton-submit.rose { background: var(--pink); box-shadow: 0 2px 12px rgba(242,109,158,0.3); }

        /* ── LABELS & INPUTS ─────────────────────── */
        label {
            display: block;
            margin-top: 16px;
            font-weight: 600;
            font-size: 0.83rem;
            color: var(--secondary-label);
        }
        input {
            width: 100%;
            padding: 12px 14px;
            margin-top: 6px;
            border: 1.5px solid var(--separator);
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            font-weight: 400;
            outline: none;
            background: #fff;
            color: var(--label);
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(16,49,115,0.15);
        }

        /* ── TABLE ───────────────────────────────── */
        table { width: 100%; border-collapse: collapse; }
        th {
            background: var(--navy);
            color: #fff;
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        td {
            padding: 12px 14px;
            border-top: 1px solid var(--separator);
            font-size: 0.9rem;
        }
        tr:hover td { background: rgba(16,49,115,0.04); }

        .type-depot     { color: var(--navy);   font-weight: 600; }
        .type-retrait   { color: var(--orange);  font-weight: 600; }
        .type-transfert { color: var(--pink);    font-weight: 600; }

        /* ── RETOUR ──────────────────────────────── */
        .lien-retour {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--navy);
            font-weight: 600;
            font-size: 0.87rem;
            text-decoration: none;
            margin-bottom: 16px;
            background: rgba(255,255,255,0.8);
            padding: 6px 14px;
            border-radius: 20px;
        }
        .lien-retour:hover { background: rgba(255,255,255,0.95); color: var(--navy); }
    </style>
</head>
<body>
    <header>
        <div class="header-inner">
            <a href="/client/dashboard" class="brand">
                <i class="bi bi-phone-fill"></i> Mobile Money
            </a>
            <?php if (session()->get('client_id') !== null): ?>
                <nav>
                    <a href="/client/dashboard"><i class="bi bi-wallet2"></i> Solde</a>
                    <a href="/client/historique"><i class="bi bi-clock-history"></i> Historique</a>
                    <a href="/client/epargne"><i class="bi bi-piggy-bank-fill"></i> Épargne</a>
                    <a href="/logout" class="nav-exit"><i class="bi bi-arrow-right-square"></i> Quitter</a>
                </nav>
            <?php endif; ?>
        </div>
    </header>

    <main>
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="message erreur">
                <i class="bi bi-exclamation-circle-fill"></i>
                <?= esc(session()->getFlashdata('erreur')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('succes')): ?>
            <div class="message succes">
                <i class="bi bi-check-circle-fill"></i>
                <?= esc(session()->getFlashdata('succes')) ?>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('contenu') ?>
    </main>
</body>
</html>
