Operateur de mobile money
        [] -conception (MIRADO, AINA)
        [] -migration (MIRADO, AINA)
        [] -Coté opérateur
                [] -prefixes valable de l'opérateur (MIRADO)
                        [] -front
                                [] -formulaire de saisie des prefixes (MIRADO)
                                [] -validation des prefixes (MIRADO)
                        [] -back
                                [] -insertion dans la base de données (MIRADO)
                [] -differentes opérations (MIRADO)
                        [] -depôt, retrait, transfert
                                [] -front 
                                        [] -tableau affichant la liste des baremes de frais par tranche (MIRADO)
                                        [] -bouton ajouter bareme (MIRADO)
                                        [] -modifier bareme (MIRADO)
                                        [] -supprimer bareme (MIRADO)
                                [] -back
                                        [] -fonction getallbareme() (MIRADO)
                                        [] -fonction CRUD bareme (MIRADO)
                                                    [] -liaison entre type_operation et bareme (MIRADO)
                [] -situation gain via les differents frais (MIRADO)
                        [] -front
                                [] -dashboard affichant le total cumulé des gains (MIRADO)
                                [] -tableau affichant les details par type d'opération (MIRADO)
                                [] -historique des gains (quelle transaction a généré quel montant de frais) (MIRADO)
                        [] -back
                                [] -fonction qui somme les gains totaux (MIRADO)
                                [] -fonction qui somme les gains par type d'opération (MIRADO)
                                [] -fonction qui retourne l'historique des gains (MIRADO)
                [] -situation compte client (MIRADO)
                        [] -front
                                [] -dashboard affichant le solde du compte (MIRADO)
                                [] -afficher le numero du client (MIRADO)
                                [] -afficher les transactions du client (MIRADO)
                        [] -back
                                [] -fonction qui retourne les infos du client (MIRADO)
                                [] -fonction qui retourne les transactions du client (MIRADO)

        [x] -Coté client
                [x] -login (AINA)
                        [x] -front
                                [x] -formulaire de login (AINA)
                        [x] -back
                                [x] -fonction de verification du numero (verification du prefixe pour l'instant) (AINA)
                [x] -operations
                        [x] -Voir le solde du compte (AINA)
                                [x] -front
                                        [x] -dashboard affichant le solde du compte (AINA)
                                [x] -back
                                        [x] -fonction qui retourne le solde du compte (AINA)
                        [x] -Faire un depôt, retrait, transfert (AINA)
                                [x] -front
                                        [x] -formulaire de saisie des informations de l'opération (AINA)
                                [x] -back
                                        [x] -fonction qui effectue l'opération et retourne le resultat (succès ou échec) (AINA)
                        [x] -Voir les historiques (AINA)
                                [x] -front
                                        [x] -tableau affichant les historiques des opérations (AINA)
                                [x] -back
                                        [x] -fonction qui retourne l'historique des opérations du client (AINA)
