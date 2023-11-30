<?php

namespace App\Form;

use App\Model\SearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('minPrice', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Min',
          'class' => 'form-control mt-1'
        ],
      ])
      ->add('maxPrice', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Max',
          'class' => 'form-control mt-1'
        ],
      ])
      ->add('minKm', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Min',
          'class' => 'form-control mt-1'
        ],
      ])
      ->add('maxKm', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Max',
          'class' => 'form-control mt-1'
        ],
      ])
      ->add('minYear', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Min',
          'class' => 'form-control mt-1'
        ],
      ])
      ->add('maxYear', IntegerType::class, [
        'label' => false,
        'required' => false,
        'attr' => [
          'placeholder' => 'Max',
          'class' => 'form-control mt-1'
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => SearchData::class,
      'method' => 'GET',
      'csrf_protection' => false
    ]);
  }

  public function getBlockPrefix()
  {
    return '';
  }
}
