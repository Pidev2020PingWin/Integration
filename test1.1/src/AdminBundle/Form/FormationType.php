<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class FormationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('nom')
            ->add('type',ChoiceType::class, [
        'choices' => [
            'Peche' => 'Peche',
            'Chasse' => 'Chasse',


        ],
    ])
           // ->add('date')
            ->add('lieu')
            ->add('description')
            ->add('heure')
           ->add('nbrplace')
            ->add('formateur', EntityType::class, array('class'=>'UserBundle:Formateur','choice_label'=>'nom','multiple'=>false))
            ->add('file');





    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Formation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_formation';
    }


}
