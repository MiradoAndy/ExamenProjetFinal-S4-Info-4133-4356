<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Money - <?= esc($titre ?? 'Espace client') ?></title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            background-color: #f4f6f8;
            color: #212529;
        }
        header {
            background-color: #0d6a4f;
            color: #fff;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header a { color: #fff; text-decoration: none; }
        header nav a { margin-left: 16px; font-weight: 500; }
        main {
            max-width: 480px;
            margin: 32px auto;
            padding: 0 16px;
        }
        .carte {
            background: #fff;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }
        .solde {
            font-size: 2rem;
            font-weight: 700;
            color: #0d6a4f;
        }
        .grille-operations {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .bouton, button {
            display: block;
            text-align: center;
            background-color: #0d6a4f;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            text-decoration: none;
            cursor: pointer;
        }
        .bouton.secondaire, button.secondaire {
            background-color: #e9ecef;
            color: #212529;
        }
        label { display: block; margin-top: 14px; font-weight: 500; }
        input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 1rem;
        }
        .message { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; }
        .message.erreur { background-color: #f8d7da; color: #842029; }
        .message.succes { background-color: #d1e7dd; color: #0f5132; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; }
        th, td { padding: 10px 12px; text-align: left; border-bottom: 1px solid #e9ecef; }
        th { background-color: #0d6a4f; color: #fff; }
        .type-depot { color: #0f5132; }
        .type-retrait, .type-transfert { color: #842029; }
    </style>
</head>
<body>
    <header>
        <a href="/client/dashboard"><strong>Mobile Money</strong></a>
        <?php if (session()->get('client_id') !== null): ?>
            <nav>
                <a href="/client/dashboard">Solde</a>
                <a href="/client/historique">Historique</a>
                <a href="/logout">Déconnexion</a>
            </nav>
        <?php endif; ?>
    </header>

    <main>
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="message erreur"><?= esc(session()->getFlashdata('erreur')) ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('succes')): ?>
            <div class="message succes"><?= esc(session()->getFlashdata('succes')) ?></div>
        <?php endif; ?>

        <?= $this->renderSection('contenu') ?>
    </main>
</body>
</html>
