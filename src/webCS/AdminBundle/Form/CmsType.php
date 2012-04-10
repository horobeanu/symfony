<?php

namespace webCS\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CmsType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('read_only'=>true))
            ->add('description')
        ;
    }

    public function getName()
    {
        return 'webcs_adminbundle_cmstype';
    }
}
