<?php
namespace Scss\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\CourseBundle\Entity\ScssClass;

class ScssClassType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('course');
    $builder->add('faculty');
    $builder->add('department');
    $builder->add('period');
  }
  
  public function getName() {
    return 'scss_class';
  }
}