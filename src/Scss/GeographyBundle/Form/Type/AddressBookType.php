<?php
namespace Scss\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\CourseBundle\Entity\AddressBook;

class AddressBookType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('latlng', new GoogleMapType());
    $builder->add('street');
    $builder->add('suburb');
    $builder->add('city');
    $builder->add('postal_code', 'number');
  }
  
  public function getName() {
    return 'address_book';
  }
}