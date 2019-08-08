<?php
/**
 * Created with PHPStorm
 * Date: 6/8/2019
 * Time: 0:22
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Form;


use App\DTO\SearchDTO;
use App\Form\Interfaces\SearchRecipeFormTypeInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchRecipeFormType extends AbstractType implements SearchRecipeFormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchString', TextType::class, [
                'label' => 'Recherche'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchDTO::class
        ]);
    }
}