<?php

namespace Troiswa\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Troiswa\TestBundle\Form\CategoryType;
use Troiswa\TestBundle\Form\MovieTagType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class MovieType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('actors', null, array('by_reference' => false))
            ->add('tags',  'collection', array(
                'type'        => new MovieTagType(),
                'allow_add'    => true,
                'allow_delete' => true,
                'by_reference' => false))
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }

    public function onPreSetData(FormEvent $event)
    {
        $movie = $event->getData();
        $form = $event->getForm();

        if (!$movie || null === $movie->getId())
        {
            $form->add('category', 'text', array('mapped' => false));
        }
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Troiswa\TestBundle\Entity\Movie'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'troiswa_testbundle_movie';
    }
}
