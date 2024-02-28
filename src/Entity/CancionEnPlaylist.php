<?php

namespace App\Entity;

use App\Repository\CancionEnPlaylistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CancionEnPlaylistRepository::class)]
class CancionEnPlaylist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id_relacion = null;

    #[ORM\ManyToOne(targetEntity: Cancion::class)]
    #[ORM\JoinColumn(name: 'id_cancion', referencedColumnName: 'id')]
    private ?Cancion $cancion = null;

    #[ORM\ManyToOne(targetEntity: Playlist::class)]
    #[ORM\JoinColumn(name: 'id_playlist', referencedColumnName: 'id')]
    private ?Playlist $playlist = null;

    public function getIdRelacion(): ?int
    {
        return $this->id_relacion;
    }

    public function getCancion(): ?Cancion
    {
        return $this->cancion;
    }

    public function setCancion(?Cancion $cancion): static
    {
        $this->cancion = $cancion;

        return $this;
    }

    public function getPlaylist(): ?Playlist
    {
        return $this->playlist;
    }

    public function setPlaylist(?Playlist $playlist): static
    {
        $this->playlist = $playlist;

        return $this;
    }
}