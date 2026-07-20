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
                [] -situation gain via les differents frais (AINA)
                        [] -front
                                [] -dashboard affichant le total cumulé des gains (AINA)
                                [] -tableau affichant les details par type d'opération (AINA)
                                [] -historique des gains (quelle transaction a généré quel montant de frais) (AINA)
                        [] -back
                                [] -fonction qui somme les gains totaux (AINA)
                                [] -fonction qui somme les gains par type d'opération (AINA)
                                [] -fonction qui retourne l'historique des gains (AINA)
                [] -situation compte client (AINA)
                        [] -front
                                [] -dashboard affichant le solde du compte (AINA)
                                [] -afficher le numero du client (AINA)
                                [] -afficher les transactions du client (AINA)
                        [] -back
                                [] -fonction qui retourne les infos du client (AINA)
                                [] -fonction qui retourne les transactions du client (AINA)

        [] -Coté client
                [] -login (MIRADO)
                        [] -front
                                [] -formulaire de login (MIRADO)
                        [] -back
                                [] -fonction de verification du numero (verification du prefixe pour l'instant) (MIRADO)
                [] -operations
                        [] -Voir le solde du compte (AINA)
                                [] -front
                                        [] -dashboard affichant le solde du compte (AINA)
                                [] -back
                                        [] -fonction qui retourne le solde du compte (AINA)
                        [] -Faire un depôt, retrait, transfert
                                [] -front
                                        [] -formulaire de saisie des informations de l'opération (MIRADO, AINA)
                                [] -back
                                        [] -fonction qui effectue l'opération et retourne le resultat (succès ou échec) (MIRADO, AINA)
