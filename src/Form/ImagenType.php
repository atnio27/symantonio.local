<?php

namespace App\Form;

use App\Entity\Imagen;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImagenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('descripcion', TextType::class, [
                'label' => 'Descripción:',
                'required' => false,
                'label_attr' => ['class' => 'etiqueta']
            ])

            ->add('numVisualizaciones')
            ->add('numLikes')
            ->add('numDownloads')
            ->add('categoria', NumberType::class, [
                'label' => 'Categoría:',
                'label_attr' => ['class' => 'etiqueta', 'value' => '1'],
                'data' => '1'
            ])



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Imagen::class,
        ]);
    }
}
