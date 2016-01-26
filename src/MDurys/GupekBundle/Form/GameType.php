<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MDurys\GupekBundle\Entity\Game;

class GameType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.game.name',
            ])
            ->add('minPlayers', IntegerType::class, [
                'label' => 'form.game.min_players',
            ])
            ->add('maxPlayers', IntegerType::class, [
                'label' => 'form.game.max_players',
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mdurys_gupekbundle_game';
    }
}
