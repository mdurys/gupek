<?php

namespace MDurys\GupekBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
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
            ->add('place', IntegerType::class)
        ;
    }

    /**
     * @param FormView      $view
     * @param FormInterface $form
     * @param array         $options
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        if ($form->getData() && $form->getData()->getUser()) {
            $view->children['place']->vars['label'] =  $form->getData()->getUser()->getUsername();
        }
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
        return 'meetinguser';
    }
}
