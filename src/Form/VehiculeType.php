<?php

namespace App\Form;

use App\Entity\Vehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $builder
                ->add('nom', null, [
                    'label' => 'Nom du véhicule',
                    'attr' => ['class' => 'form-control']
                ])
                ->add('modele', null, [
                    'label' => 'Modèle du véhicule',
                    'attr' => ['class' => 'form-control']
                ])
                ->add('description', null, [
                    'label' => 'Description',
                    'attr' => ['class' => 'form-control']
                ])
                ->add('date_creation', null, [
                    'label' => 'Date de création',
                    'attr' => ['class' => 'form-control']
                ])
                ->add('image', null, [
                    'label' => 'Image du véhicule',
                    'attr' => ['class' => 'form-control']
                ])
                
                ->add('en_vente', null, [
                    'label' => 'En Vente',
                    'attr' => ['class' => 'form-check-input']
                ])
                ->add('creer', SubmitType::class, [
                    'label' => isset($options["label"]) ? $options["label"] : "Ajouter",
                    'attr' => ['class' => 'btn btn-outline-danger mt-3']
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
