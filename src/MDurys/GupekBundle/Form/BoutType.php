<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MDurys\GupekBundle\Entity\Bout;

class BoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('game', EntityType::class, [
                'class' => 'MDurysGupekBundle:Game',
                'choice_label' => 'name',
                'label' => 'form.bout.game',
                ])
            ->add('maxPlayers', IntegerType::class, [
                'label' => 'form.bout.max_players',
                'attr' => [
                    'help_text' => 'form.bout.max_players_help'
                    ]
                ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bout::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mdurys_gupekbundle_bout';
    }
}
