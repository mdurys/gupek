<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use MDurys\GupekBundle\Entity\Bout;

class BoutScoreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meetingUsers', CollectionType::class, [
                'entry_type' => MeetingUserType::class,
                'entry_options' => [
                    'required' => true
                ],
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
        return 'bout_score';
    }
}
