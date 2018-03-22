<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Restaraunt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add(
                      
                      'restaraunt',
                        EntityType::class,
                      [
                          'label'=>'restaraunt',
                          'class' => Restaraunt::class,
                            // nom du champ qui s'affiche dans les options
                            'choice_label' => 'nom',
                            // 1ère option vide
                            'placeholder' => 'Choisissez un restaurant',
                      ]
                   )
                
            ->add('content', TextareaType::class, array(
                'label' => 'Ecrivez votre article',
                'attr' => array('cols' => '5', 'rows' => '15')
            ))
            ->add('description', TextareaType::class, [
                'label' => 'description'
            ])
            
            ->add('image1', FileType::class, [
                        'label' => "Illustration",
                        'required' => false, 
            ])
            ->add('image2', FileType::class, [
                        'label' => "Illustration",
                        'required' => false, 
            ])
            ->add('image3', FileType::class, [
                        'label' => "Illustration",
                        'required' => false, 
            ]);
        
        
        if (!is_null($options['data']->getImage1())) {
            $builder->add(
                'remove_image1',
                CheckboxType::class,
                [
                    'label' => "Supprimer l'illustration",
                    'required' => false,
                    // champ non relié à un attribut de l'entité Article
                    'mapped' => false
                ]
            );
        }
        if (!is_null($options['data']->getImage2())) {
            $builder->add(
                'remove_image2',
                CheckboxType::class,
                [
                    'label' => "Supprimer l'illustration",
                    'required' => false,
                    // champ non relié à un attribut de l'entité Article
                    'mapped' => false
                ]
            );
        }
        if (!is_null($options['data']->getImage3())) {
            $builder->add(
                'remove_image3',
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
            'data_class' => Article::class,
        ]);
    }
}
