<?php

namespace App\Form;

use App\Entity\Recipe;
use App\Repository\IngredientRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditRecipeType extends AbstractType
{
    private $ingredientRepository;

    public function __construct(IngredientRepository $repository)
    {
        $this->ingredientRepository = $repository;
        $this->ingredient = $this->ingredientRepository->findAll();
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('preparation')
            // TODO: Spread the array
            ->add('ingredient', ChoiceType::class, ['label' => 'Ingredient',
                'choices' => $this->ingredient])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
