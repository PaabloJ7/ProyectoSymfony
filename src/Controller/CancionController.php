<?php
// src/Controller/PlaylistController.php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\CancionRepository;
use App\Repository\PlaylistRepository;
use Doctrine\ORM\EntityManagerInterface;
Use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Entity\Cancion;
use App\Form\CancionType;


use Symfony\Component\Routing\Annotation\Route;

#[Route('/canciones')]
class CancionController extends AbstractController
{
    // Ruta para mostrar todas las canciones y listas de reproducción
    #[Route('/', name: 'app_canciones_index', methods: ['GET'])]
    public function index(CancionRepository $cancionRepository, PlaylistRepository $playlistRepository): Response
    {
        // Obtener el usuario actual
        $user = $this->getUser();

        // Filtrar listas de reproducción por el usuario actual
        $playlists = ($user) ? $playlistRepository->findBy(['id_usuario' => $user->getId()]) : [];

        // Renderizar la vista con todas las canciones y listas de reproducción
        return $this->render('canciones/index.html.twig', [
            'Cancion' => $cancionRepository->findAll(),
            'playlists' => $playlists,
        ]);
    }

    // Permite agregar una nueva canción.
    #[Route('/new', name: 'app_canciones_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cancion = new Cancion();
        $form = $this->createForm(CancionType::class, $cancion);
        $form->handleRequest($request);

        // Procesa y almacena la nueva canción si el formulario es válido.
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleFileUpload($cancion);
            $entityManager->persist($cancion);
            $entityManager->flush();

            return $this->redirectToRoute('app_canciones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('canciones/new.html.twig', [
            'cancion' => $cancion,
            'form' => $form->createView(),
        ]);
    }

    // Elimina una canción.
    #[Route('/{id}', name: 'app_canciones_delete', methods: ['POST'])]
    public function delete(Request $request, Cancion $cancion, EntityManagerInterface $entityManager): Response
    {
        // Elimina la canción si el token CSRF es válido.
        if ($this->isCsrfTokenValid('delete' . $cancion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cancion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_canciones_index', [], Response::HTTP_SEE_OTHER);
    }

    // Maneja la carga de archivos asociados a las canciones.
    private function handleFileUpload(Cancion $cancion): void
    {
        $archivo = $cancion->getArchivo();

        // Mueve el archivo al directorio de música con su nombre original.
        if ($archivo instanceof File) {
            $archivo->move($this->getParameter('music_directory'), $archivo->getClientOriginalName());
        }
    }

    #[Route('/add-to-playlist/{playlistId}/{cancionId}', name: 'app_add_to_playlist', methods: ['POST'])]
public function addToPlaylist(EntityManagerInterface $entityManager, $playlistId, $cancionId): Response
{
    $playlist = $entityManager->getRepository(Playlist::class)->find($playlistId);
    $cancion = $entityManager->getRepository(Cancion::class)->find($cancionId);

    if (!$playlist || !$cancion) {
        throw $this->createNotFoundException('Playlist or song not found.');
    }

    // Check if the song is already in the playlist
    if (!$playlist->getCanciones()->contains($cancion)) {
        $playlist->addCancion($cancion);
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_canciones_index');
}
    
}
