<?php

namespace App\Form;

use App\Entity\Playlist;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Cancion;

class PlaylistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nombre')
            ->add('ImagenFile', FileType::class, [
                'label' => 'Imagen',
                'required' => false,
            ])
            ->add('canciones', EntityType::class, [
                'class' => Cancion::class,
                'choice_label' => 'titulo',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false, // Required to modify the ArrayCollection in the Playlist entity
                'label' => 'Canciones',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Playlist::class,
        ]);
    }
}