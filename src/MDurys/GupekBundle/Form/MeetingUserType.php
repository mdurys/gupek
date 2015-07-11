<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MDurys\GupekBundle\Entity\MeetingUser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mdurys_gupekbundle_meetinguser';
    }
}
