Operateur de mobile money
        [] -conception (Mirado, Aina)
        [] -migration (Mirado)
        [] -Coté opérateur
                [] -prefixes valable de l'opérateur 
                        [] -front
                                [] -formulaire de saisie des prefixes
                                [] -validation des prefixes
                        [] -back
                                [] -insertion dans la base de données   
                [] -differentes opérations 
                        [] -depôt, retrait, transfert
                                [] -front 
                                        [] -tableau affichant la liste des baremes de frais par tranche
                                        [] -bouton ajouter bareme
                                        [] -modifier bareme
                                        [] -supprimer bareme
                                [] -back
                                        [] -fonction getallbareme()
                                        [] -fonction CRUD bareme 
                                                    [] -liaison entre type_operation et bareme
                [] -situation gain via les differents frais
                        [] -front
                                [] -dashboard affichant le total cumulé des gains
                                [] -tableau affichant les details par type d'opération
                                [] -historique des gains (quelle transaction a généré quel montant de frais)
                        [] -back
                                [] -fonction qui somme les gains totaux
                                [] -fonction qui somme les gains par type d'opération
                                [] -fonction qui retourne l'historique des gains
                [] -situation compte client
                        [] -front
                                [] -dashboard affichant le solde du compte
                                [] -afficher le numero du client
                                [] -afficher les transactions du client 
                        [] -back
                                [] -fonction qui retourne les infos du client
                                [] -fonction qui retourne les transactions du client

        [] -Coté client
                [] -login
                        [] -front
                                [] -formulaire de login
                        [] -back
                                [] -fonction de verification du numero (verification du prefixe pour l'instant)
                [] -operations
                        [] -Voir le solde du compte
                                [] -front
                                        [] -dashboard affichant le solde du compte
                                [] -back
                                        [] -fonction qui retourne le solde du compte
                        [] -Faire un depôt, retrait, transfert
                                [] -front
                                        [] -formulaire de saisie des informations de l'opération
                                [] -back
                                        [] -fonction qui effectue l'opération et retourne le resultat (succès ou échec)
                       
