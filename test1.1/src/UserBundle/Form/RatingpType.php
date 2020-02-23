<?php


namespace UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RatingpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('degre',ChoiceType::class, [
                'choices'  => [
                    'Très Satisfait' => 'Très Satisfait',
                    'Satisfait' => 'Satisfait',
                    'Passable' => 'Passable',
                    'Insatisfait' => 'Insatisfait',
                    'Très InSatisfait' => 'Très InSatisfait',


                ],
            ])
            ->add('commentaire')




        ;
    }
}