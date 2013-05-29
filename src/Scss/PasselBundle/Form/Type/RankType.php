<?php
namespace Scss\PasselBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Scss\PasselBundle\Entity\Rank;

class RankType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('special');
    $builder->add('organization');
  }
  
  public function getName() {
    return 'rank';
  }
}