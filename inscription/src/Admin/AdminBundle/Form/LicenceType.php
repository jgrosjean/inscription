<?php

namespace Admin\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class LicenceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
          ->add('intitule', 'text')

          ->add('descriptionComplete',          'text', array(    'label'    => 'Description complète',    'required' => true,))
          ->add('description1',          'text', array(    'label'    => 'Description succinte 1',    'required' => true,))
          ->add('description2',          'text', array(    'label'    => 'Description succinte 2',    'required' => true,))
          ->add('description3',          'text', array(    'label'    => 'Description succinte 3',    'required' => true,))

          ->add('prix',       'integer', array(    'label'    => 'Prix licence',    'required' => false,))
          ->add('categorie',       'choice', array('choices' => array('adulte'=>'adulte',
                                                                      'jeune'=>'jeune')))
          ->add('reduction',       'checkbox', array(    'label'    => 'Offre pour une réduction ?',    'required' => false,))
          ->add('visible',       'checkbox', array(    'label'    => 'offre visible ?',    'required' => false,))
          ->add('Envoyer',        'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Admin\AdminBundle\Entity\Licence'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'admin_adminbundle_creerlicence';
    }
}