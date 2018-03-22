<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                       'email',
                       EmailType::class,
                        [
                            'label'=>'email'
                        ]
                        
                    )
            ->add(
                       'objet',
                       TextareaType::class,
                        [
                            'label'=>'Objet'
                        ]
                        
                    )
            ->add(
                       'message',
                       TextareaType::class,
                        [
                            'label'=>'Message'
                        ]
                        
    );
        
    }
                

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Contact::class,
        ]);
    }
}
