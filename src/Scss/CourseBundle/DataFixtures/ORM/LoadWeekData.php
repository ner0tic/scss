<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Week;
  
  class LoadWeekData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      $week1 = new Week();
      $week1->setName('Week 1');
      $week1->setSpecial(true);
      $manager->persist($week1);
    }