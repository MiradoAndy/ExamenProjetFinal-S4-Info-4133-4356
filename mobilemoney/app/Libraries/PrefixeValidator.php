<?php

namespace App\Libraries;

use App\Models\PrefixeModel;

/**
 * Vérifie qu'un numéro de téléphone commence par un préfixe
 * valable de l'opérateur (table `prefixe`, ex: 033, 037).
 *
 * Pour l'instant, c'est la seule vérification faite sur le numéro
 * lors du login (pas d'inscription préalable du client).
 */
class PrefixeValidator
{
    /** Nombre de chiffres qui composent un préfixe (ex: "033"). */
    private const LONGUEUR_PREFIXE = 3;

    protected PrefixeModel $prefixeModel;

    public function __construct(?PrefixeModel $prefixeModel = null)
    {
        $this->prefixeModel = $prefixeModel ?? new PrefixeModel();
    }

    /**
     * Retourne true si le numéro est uniquement composé de chiffres
     * et que ses 3 premiers chiffres correspondent à un préfixe existant.
     */
    public function estValide(string $numero): bool
    {
        $numero = trim($numero);

        if (! ctype_digit($numero) || strlen($numero) <= self::LONGUEUR_PREFIXE) {
            return false;
        }

        $prefixe = substr($numero, 0, self::LONGUEUR_PREFIXE);

        return $this->prefixeModel->where('valeur', $prefixe)->first() !== null;
    }
}
