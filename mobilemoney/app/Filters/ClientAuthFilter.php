<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Protège les pages réservées aux clients connectés (dashboard, opérations, historique).
 * Redirige vers la page de login si aucun client n'est authentifié en session.
 */
class ClientAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('client_id') === null) {
            return redirect()->to('/login')->with('erreur', 'Veuillez vous connecter pour continuer.');
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Rien à faire après la requête.
    }
}
