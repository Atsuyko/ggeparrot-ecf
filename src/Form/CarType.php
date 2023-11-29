<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Option;
use App\Repository\OptionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Marque',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 50]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('model', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Model',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 2, 'max' => 100]),
                    new Assert\NotBlank()
                ]
            ])
            ->add('year', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Année',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ]
            ])
            ->add('km', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Kilométrage',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\PositiveOrZero()
                ]
            ])
            ->add('price', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prix',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\PositiveOrZero()
                ]
            ])
            ->add('teaserImg', FileType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => "Image vitrine",
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez sélectionner un fichier PNG / JPG / JPEG',
                    ])
                ]
            ])
            ->add('img1', FileType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => "Image 1",
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez sélectionner un fichier PNG / JPG / JPEG',
                    ])
                ]
            ])
            ->add('img2', FileType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => "Image 2",
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez sélectionner un fichier PNG / JPG / JPEG',
                    ])
                ]
            ])
            ->add('img3', FileType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => "Image 3",
                'label_attr' => [
                    'class' => 'form-label mt-3',
                ],
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Veuillez sélectionner un fichier PNG / JPG / JPEG',
                    ])
                ]
            ])
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'label' => 'Options',
                'label_attr' => [
                    'class' => 'form-label mt-3'
                ],
                'query_builder' => function (OptionRepository $optionRepository) {
                    return $optionRepository->createQueryBuilder('option')
                        ->orderBy('option.name', 'ASC');
                },
                'choice_attr' => function () {
                    return [
                        'style' => 'margin-left: 10px; margin-right: 2px;',
                        'class' => 'form-check-input'
                    ];
                },
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-outline-primary my-3'
                ],
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
