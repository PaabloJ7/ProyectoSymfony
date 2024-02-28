<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CancionRepository;
use Symfony\Component\HttpFoundation\Request;

class BuscadorController extends AbstractController
{
    #[Route('/buscador', name: 'app_buscador')]
    public function index(Request $request, CancionRepository $cancionRepository): Response
    {
        $termino = $request->query->get('termino');
        $canciones = $cancionRepository->buscarCanciones($termino);
    
        return $this->render('buscador/index.html.twig', [
            'canciones' => $canciones,
            'controller_name' => 'BuscadorController',
        ]);
    }
}