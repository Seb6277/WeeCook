<?php
/**
 * Created with PHPStorm
 * Date: 21/8/2019
 * Time: 9:43
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Form;


use App\DTO\UpdateUserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class EditPasswordType
 * @package App\Form
 */
class EditPasswordType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', PasswordType::class, ['label' => 'Mot de passe :'])
            ->add('retypePassword', PasswordType::class, ['label' => 'vérifiez le mot de passe :']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UpdateUserDTO::class
        ]);
    }
}