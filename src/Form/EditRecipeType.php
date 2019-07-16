<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Repository\IngredientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class EditRecipeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //TODO: Validation and presentation; Validation ever done for image file upload
        $builder
            ->add('name')
            ->add('preparation', TextareaType::class, ['attr' => [
                'class' => 'preparation'
            ]])
            ->add('image1', FileType::class, [
                'label' => 'Photo du plat',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Veuillez fournir un fichier png ou jpg valide'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
