<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('game', 'entity', [
                'class' => 'MDurysGupekBundle:Game',
                'property' => 'name',
                'label' => 'form.bout.game',
                ])
            ->add('maxPlayers', 'integer', [
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
            'data_class' => \MDurys\GupekBundle\Entity\Bout::class
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
