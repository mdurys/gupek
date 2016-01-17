<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use MDurys\GupekBundle\Entity\Meeting;

class MeetingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'datetime', ['label' => 'form.meeting.date', 'minutes' => [0, 30]])
            ->add('season')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meeting::class
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mdurys_gupekbundle_meeting';
    }
}
