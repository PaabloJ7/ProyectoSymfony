<?php
// src/Controller/PlaylistController.php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;


class PlaylistController extends AbstractController
{
    #[Route('/playlist/new', name: 'playlist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playlist = new Playlist();
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtén el usuario actualmente autenticado
            $user = $this->getUser();
        
            // Comprueba si el usuario está autenticado
            if (!$user) {
                throw $this->createAccessDeniedException('Debes estar autenticado para crear una lista de reproducción.');
            }
        
            // Obtén el archivo de imagen del formulario
            $imagenFile = $form->get('ImagenFile')->getData();
        
            // Si se ha subido un archivo de imagen
            if ($imagenFile) {
                $originalFilename = pathinfo($imagenFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Reemplaza los caracteres no alfanuméricos y convierte el nombre del archivo a minúsculas
                $safeFilename = strtolower(preg_replace('/[^A-Za-z0-9_]/', '', $originalFilename));
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imagenFile->guessExtension();
        
                // Mueve el archivo a la carpeta de imágenes
                try {
                    $imagenFile->move(
                        $this->getParameter('imagenes_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... maneja la excepción si algo sale mal durante el guardado del archivo
                }
        
                // Actualiza la propiedad 'Imagen' para almacenar el nombre del archivo de imagen
                $playlist->setImagen($newFilename);
            }
        
            // Establece el usuario en la lista de reproducción
            $playlist->setIdUsuario($user->getId());
        
            $entityManager->persist($playlist);
            $entityManager->flush();
        
            return $this->redirectToRoute('app_canciones_index');
        }
    
        // Renderiza el formulario y devuelve la respuesta
        return $this->render('playlist/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
        }
    
