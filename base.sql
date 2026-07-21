-- ===========================================
-- BASE.SQL - Mobile Money
-- ===========================================

PRAGMA foreign_keys = ON;

-- -------------------------------------------
-- TABLES
-- -------------------------------------------

CREATE TABLE IF NOT EXISTS prefixe (
    id_prefixe              INTEGER PRIMARY KEY AUTOINCREMENT,
    valeur                  TEXT NOT NULL UNIQUE,  -- ex: 033, 037
    est_externe             INTEGER NOT NULL DEFAULT 0,  -- 0=notre opérateur, 1=autre opérateur
    pourcentage_commission  REAL NOT NULL DEFAULT 0      -- % de commission inter-opérateur
);

CREATE TABLE IF NOT EXISTS client (
    id_client   INTEGER PRIMARY KEY AUTOINCREMENT,
    numero      TEXT NOT NULL UNIQUE, -- ex: 0331234567
    solde       REAL NOT NULL DEFAULT 0,
    pourcentage_epargne INTEGER DEFAULT 0,
    solde_epargne REAL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS type_operation (
    id_type_operation   INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle             TEXT NOT NULL UNIQUE -- depot, retrait, transfert
);

CREATE TABLE IF NOT EXISTS bareme_frais (
    id_bareme_frais     INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id   INTEGER NOT NULL,
    montant_min         REAL NOT NULL,
    montant_max         REAL NOT NULL,
    frais               REAL NOT NULL,
    FOREIGN KEY (type_operation_id) REFERENCES type_operation(id_type_operation)
);

CREATE TABLE IF NOT EXISTS historique_operation (
    id_operation        INTEGER PRIMARY KEY AUTOINCREMENT,
    type_operation_id   INTEGER NOT NULL,
    montant             REAL NOT NULL,
    frais               REAL NOT NULL DEFAULT 0,
    frais_commission    REAL NOT NULL DEFAULT 0, -- commission inter-opérateur (reversée à l'autre opérateur)
    client_id           INTEGER NOT NULL,
    date                DATETIME NOT NULL DEFAULT (datetime('now')),
    numero_destinataire TEXT, -- NULL pour depot/retrait, rempli pour transfert
    FOREIGN KEY (type_operation_id) REFERENCES type_operation(id_type_operation),
    FOREIGN KEY (client_id) REFERENCES client(id_client)
);

-- -------------------------------------------
-- DONNÉES INITIALES
-- -------------------------------------------

-- Préfixes de notre opérateur (est_externe = 0)
INSERT INTO prefixe (valeur, est_externe, pourcentage_commission) VALUES ('033', 0, 0);
INSERT INTO prefixe (valeur, est_externe, pourcentage_commission) VALUES ('037', 0, 0);

-- Types d'opérations
INSERT INTO type_operation (libelle) VALUES ('depot');
INSERT INTO type_operation (libelle) VALUES ('retrait');
INSERT INTO type_operation (libelle) VALUES ('transfert');

-- Barème retrait (id_type_operation = 2)
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 100,       1000,       50);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 1001,      5000,       50);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 5001,      10000,      100);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 10001,     25000,      200);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 25001,     50000,      400);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 50001,     100000,     800);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 100001,    250000,     1500);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 250001,    500000,     1500);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 500001,    1000000,    2500);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (2, 1000001,   2000000,    3000);

-- Barème transfert (id_type_operation = 3)
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 100,       1000,       50);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 1001,      5000,       50);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 5001,      10000,      100);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 10001,     25000,      200);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 25001,     50000,      400);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 50001,     100000,     800);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 100001,    250000,     1500);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 250001,    500000,     1500);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 500001,    1000000,    2500);
INSERT INTO bareme_frais (type_operation_id, montant_min, montant_max, frais) VALUES (3, 1000001,   2000000,    3000);

-- Clients de test
INSERT INTO client (numero, solde) VALUES ('0331234567', 50000);
INSERT INTO client (numero, solde) VALUES ('0337654321', 120000);
INSERT INTO client (numero, solde) VALUES ('0371111111', 200000);
