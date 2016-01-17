<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MDurys\GupekBundle\Entity\MeetingUser;

class MeetingUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('id', 'hidden')
            ->add('place', 'integer')
            // ->add('score')
            // ->add('win')
            // ->add('meeting')
            // ->add('user')
            // ->add('bout')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeetingUser::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mdurys_gupekbundle_meetinguser';
    }
}
