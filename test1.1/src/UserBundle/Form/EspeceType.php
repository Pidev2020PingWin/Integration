<?php


namespace UserBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class EspeceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('categorie', EntityType::class, array('class'=>'UserBundle:CategorieEspece','choice_label'=>'nom','multiple'=>false))
            ->add('file')
            ->add('description')
            ->add('type')
            ->add('Envoyer',      SubmitType::class)


        ;
    }
}