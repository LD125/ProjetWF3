<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'pseudo',
                    TextType::class,
                    [
                        'label'=>'Pseudo :'
                    ]
                    
                )
                
                ->add(
                   'plainPassword',     
                PasswordType::class,
                      [
                          'label'=>'Mot de passe :'
                      ]  
                        
                )
                
                ->add(
                       'email',
                       EmailType::class,
                        [
                            'label'=>'Email :'
                        ]
                        
                    )
        ;
        
        if ($options['data']->getIdmembre()) {
                $builder->add(
                       'role',
                       ChoiceType::class,
                        [
                            'choices' =>array('ADMIN' => 'ROLE_ADMIN',
                                              'USER' =>'ROLE_USER'),
                            'label'=>'Role :'
                        ]
                        
                    )
                
             ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
