Operateur de mobile money
        [x] -conception (MIRADO, AINA)
        [x] -migration (MIRADO, AINA)
        [x] -Coté opérateur
                [x] -prefixes valable de l'opérateur (MIRADO)
                        [x] -front
                                [x] -formulaire de saisie des prefixes (MIRADO)
                                [x] -validation des prefixes (MIRADO)
                        [x] -back
                                [x] -insertion dans la base de données (MIRADO)
                [x] -differentes opérations (MIRADO)
                        [x] -depôt, retrait, transfert
                                [x] -front 
                                        [x] -tableau affichant la liste des baremes de frais par tranche (MIRADO)
                                        [x] -bouton ajouter bareme (MIRADO)
                                        [x] -modifier bareme (MIRADO)
                                        [x] -supprimer bareme (MIRADO)
                                [x] -back
                                        [x] -fonction getallbareme() (MIRADO)
                                        [x] -fonction CRUD bareme (MIRADO)
                                                    [x] -liaison entre type_operation et bareme (MIRADO)
                [x] -situation gain via les differents frais (MIRADO)
                        [x] -front
                                [x] -dashboard affichant le total cumulé des gains (MIRADO)
                                [x] -tableau affichant les details par type d'opération (MIRADO)
                                [x] -historique des gains (quelle transaction a généré quel montant de frais) (MIRADO)
                        [x] -back
                                [x] -fonction qui somme les gains totaux (MIRADO)
                                [x] -fonction qui somme les gains par type d'opération (MIRADO)
                                [x] -fonction qui retourne l'historique des gains (MIRADO)
                [x] -situation compte client (MIRADO)
                        [x] -front
                                [x] -dashboard affichant le solde du compte (MIRADO)
                                [x] -afficher le numero du client (MIRADO)
                                [x] -afficher les transactions du client (MIRADO)
                        [x] -back
                                [x] -fonction qui retourne les infos du client (MIRADO)
                                [x] -fonction qui retourne les transactions du client (MIRADO)

        [] -Coté client
                [] -login (AINA)
                        [] -front
                                [] -formulaire de login (AINA)
                        [] -back
                                [] -fonction de verification du numero (verification du prefixe pour l'instant) (AINA)
                [] -operations
                        [] -Voir le solde du compte (AINA)
                                [] -front
                                        [] -dashboard affichant le solde du compte (AINA)
                                [] -back
                                        [] -fonction qui retourne le solde du compte (AINA)
                        [] -Faire un depôt, retrait, transfert (AINA)
                                [] -front
                                        [] -formulaire de saisie des informations de l'opération (AINA)
                                [] -back
                                        [] -fonction qui effectue l'opération et retourne le resultat (succès ou échec) (AINA)
                        [] -Voir les historiques (AINA)
                                [] -front
                                        [] -tableau affichant les historiques des opérations (AINA)
                                [] -back
                                        [] -fonction qui retourne l'historique des opérations du client (AINA)
