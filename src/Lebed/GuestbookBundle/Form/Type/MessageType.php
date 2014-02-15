<?php

namespace Lebed\GuestbookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', 'text', array('label'=>'Your Name: '))
            ->add('mail', 'email', array('label'=>'Email: '))
            ->add('message', 'textarea')
            ->add('save', 'submit')
            ->getForm();
    }

    public function getName()
    {
        return 'message';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Lebed\GuestbookBundle\Entity\Message',
        ));
    }
}

