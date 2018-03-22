<?php


namespace App\Form;

use App\Entity\Restaraunt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestarauntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'nom',
                TextType::class,
                [
                    'label' => 'Nom :'
                ]
            )
            ->add(
                'ville',
                TextType::class,
                [
                    'label' => 'Ville :'
                ]
            )
            ->add(
                'note',
               ChoiceType::class,
                        [
                            'choices' =>array('1' => '1',
                                              '2' => '2',
                                              '3' => '3',
                                              '4' => '4',
                                              '5' => '5'),
                            'label'=>'Note : '
                        ]
                        
            )
            ->add(   
                'adresse',
                   TextAreaType::class,
                   [
                      'label'=>'Adresse :'
                   ]         
                )
                
            ->add(   
                'telephone',
                TelType::class,
                   [
                      'label'=>'Téléphone :'
                   ]         
                )
                
            ->add(
                'cdp',
                
                IntegerType::class,
                [
                    'label'=>'Code postal :'
                ]
            ) 
            ->add(
                'specialite',
               
               ChoiceType::class,
                [
                    'choices'=>array('Chinoise'=>'Chinoise',
                                     
                                     'Francaise'=>'Francaise',
                                     'Thailandaise'=>'Thailandaise',
                                     'Indienne'=>'Indienne',
                                     'Libanaise'=>'Libanaise',  
                                     'Japonaise'=>'Japonaise',
                                     'Africaine'=>'Africaine',
                                     'Mexicaine'=>'Mexicaine',
                                     'Marocaine'=>'Marocaine',
                                     'Italienne'=>'Italienne'
                        


                        )
                ]
               )
                ->add(
                'image',
                // input type file
                FileType::class,
                [
                    'label' => 'Illustration :',
                    'required' => false
                ]
            )
               
             ->add(
                     'description',
                     TextareaType::class,
                     [
                         'label'=>'Description :'
                     ]
                     
                )
                
              ->add(
                      
                  'article',
                   TextAreaType::class, array(
                'label' => 'Contenu :',
                'attr' => array('cols' => '5', 'rows' => '15')
            ));
        
        // $options['data'] = L'entité Article
        if (!is_null($options['data']->getImage())) {
            $builder->add(
                'remove_image',
                CheckboxType::class,
                [
                    'label' => "Supprimer l'illustration",
                    'required' => false,
                    // champ non relié à un attribut de l'entité Article
                    'mapped' => false
                ]
            );
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Restaraunt::class,
        ]);
    }
}