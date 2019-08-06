<?php
/**
 * Created with PHPStorm
 * Date: 6/8/2019
 * Time: 0:24
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Form\Interfaces;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

interface SearchRecipeFormTypeInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options);
    public function configureOptions(OptionsResolver $resolver);
}