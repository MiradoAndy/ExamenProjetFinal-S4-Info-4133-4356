Operateur de mobile money
[x] -V1
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
                        
[]-V2
        [] -Coté opérateur (MIRADO)
                [] -Configuration des préfixes valable pour les autres opérateurs (MIRADO)
                        [] -un formulaire de saisie des préfixes (MIRADO)
                        [] -validation des préfixes (MIRADO)
                        [] -inclure une nouvelle table pour les préfixes des autres opérateurs (MIRADO)
                [] -Configuration % en plus de commissions pour les transferts vers les autres opérateurs 
                        [] -ajouter un frais en plus pour les transferts vers les autres opérateurs (MIRADO)
                        [] -un formulaire de saisie du % en plus de commissions (MIRADO)
                                [] -dropdown pour choisir si la valeur choisie est un pourcentage ou un montant fixe (MIRADO)
                        [] -validation du % en plus de commissions (MIRADO)
                [] -Situation gain via les différents frais (MIRADO)
                        [] -séparer les gains obtenu de l'operateur des gains des autres operateurs (MIRADO)
                [] -Situation des montants à envoyer à chaque opérateur (MIRADO)
                        [] -front (MIRADO)
                                [] -dashboard affichant le montant total à envoyer à chaque opérateur (MIRADO)
                        [] -back (MIRADO)
                                [] -fonction qui retourne le montant total à envoyer à chaque opérateur (MIRADO)
        [] -Coté client (AINA)
                [] -option inclure frais de retrait lors de l'envoi (AINA)
                        [] -front (AINA)
                                [] -checkbox pour inclure les frais de retrait lors de l'envoi (AINA)
                        [] -back (AINA)
                                [] -si inclu: l'expediteur paie montant + frais de transfert + frais de retrait (AINA)
                                [] -si pas inclu: le destinataire paie montant + frais de retrait (AINA)
                [] -envoie multiple vers plusieurs numero (AINA)
                        [] -front (AINA)
                                [] -bouton plus pour plusieurs champs de saisie de numero (AINA)
                        [] -back (AINA)
                                [] -division equite du montant à envoyer entre les différents destinataires (AINA)
