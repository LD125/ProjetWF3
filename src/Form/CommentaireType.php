<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Restaraunt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                   'commentaire',
                   TextareaType::class, array(
                'label' => 'Ecrivez votre commentaire',
                'attr' => array('cols' => '5', 'rows' => '8'))  
              )
             ->add(
                    'notecomment',
                        ChoiceType::class,
                        [
                            'choices' =>array('1' => '1',
                                              '2' => '2',
                                              '3' => '3',
                                              '4' => '4',
                                              '5' => '5'),
                            'label'=>'Note : '
                        ]
                        
            );
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}