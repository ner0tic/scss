<?php
namespace Scss\OrganizationBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AttendeeType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('first_name');
        $builder->add('last_name');
        $builder->add('birthdate', 'birthday');
        $builder->add('sub_group');
        $builder->add('group');
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Scss\OrganizationBundle\Entity\Attendee'
        ));
    }

    public function getName()
    {
        return 'scss_organizationbundle_attendeetype';
    }
}
