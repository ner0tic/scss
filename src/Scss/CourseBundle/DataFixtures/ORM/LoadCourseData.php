<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Course;
  
  class LoadCourseData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camp Hinds
      $CH_H2o = new Course();
      $CH_H2o->setName('waterfront');
      $CH_H2o->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_H2o);
      
      // Camp Hinds - Main Beach
      $CH_MainBeach = new Course();
      $CH_MainBeach->setName('main beach');
      $CH_MainBeach->setParent($manager->merge($this->getReference('ch-waterfront')));
      $CH_MainBeach->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_MainBeach);       
    }
    
    public function getOrder() { return 1; }
  }
