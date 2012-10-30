<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\ScssClass;
  
  class LoadClassData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // hinds :: wk1 :: pd1 :: swimming
      $swim1 = new ScssClass();
      $swim1->setName('Swimming');
      $swim1->setFaculty($manager->merge($this->getReference('hinds')));
      $swim1->setCourse($manager->merge($this->getReference('crs-swimming')));
      $swim1->setDepartment($manager->merge($this->getReference('ch-mainbeach')));
      $swim1->setPeriod($manager->merge($this->getReference('ch-w1-p1')));
      $manager->persist($swim1);
      $this->addReference('ch-w1-p1-cls-swimming', $swim1);
      
      // hinds :: wk1 :: pd2 :: swimming
      $swim2 = new ScssClass();
      $swim2->setName('Swimming');
      $swim2->setFaculty($manager->merge($this->getReference('hinds')));
      $swim2->setCourse($manager->merge($this->getReference('crs-swimming')));
      $swim2->setDepartment($manager->merge($this->getReference('ch-mainbeach')));
      $swim2->setPeriod($manager->merge($this->getReference('ch-w1-p2')));
      $manager->persist($swim2);
      $this->addReference('ch-w1-p2-cls-swimming', $swim2);
      
      // hinds :: wk1 :: pd3 :: swimming
      $swim3 = new ScssClass();
      $swim3->setName('Swimming');
      $swim3->setFaculty($manager->merge($this->getReference('hinds')));
      $swim3->setCourse($manager->merge($this->getReference('crs-swimming')));
      $swim3->setDepartment($manager->merge($this->getReference('ch-mainbeach')));
      $swim3->setPeriod($manager->merge($this->getReference('ch-w1-p3')));
      $manager->persist($swim3);
      $this->addReference('ch-w1-p3-cls-swimming', $swim3);
      
      // hinds :: wk1 :: pd1 :: camping
      $camp1 = new ScssClass();
      $camp1->setName('Camping');
      $camp1->setFaculty($manager->merge($this->getReference('hinds')));
      $camp1->setCourse($manager->merge($this->getReference('crs-camping')));
      $camp1->setDepartment($manager->merge($this->getReference('ch-scoutcraft')));
      $camp1->setPeriod($manager->merge($this->getReference('ch-w1-p1')));
      $manager->persist($camp1);
      $this->addReference('ch-w1-p1-cls-camping', $camp1);
      
      // hinds :: wk1 :: pd2 :: camping
      $camp2 = new ScssClass();
      $camp2->setName('Camping');
      $camp2->setFaculty($manager->merge($this->getReference('hinds')));
      $camp2->setCourse($manager->merge($this->getReference('crs-camping')));
      $camp2->setDepartment($manager->merge($this->getReference('ch-scoutcraft')));
      $camp2->setPeriod($manager->merge($this->getReference('ch-w1-p2')));
      $manager->persist($camp2);
      $this->addReference('ch-w1-p2-cls-camping', $camp2);
      
      // hinds :: wk1 :: pd3 :: camping
      $camp3 = new ScssClass();
      $camp3->setName('Camping');
      $camp3->setFaculty($manager->merge($this->getReference('hinds')));
      $camp3->setCourse($manager->merge($this->getReference('crs-camping')));
      $camp3->setDepartment($manager->merge($this->getReference('ch-scoutcraft')));
      $camp3->setPeriod($manager->merge($this->getReference('ch-w1-p3')));
      $manager->persist($camp3);
      $this->addReference('ch-w1-p3-cls-camping', $camp3);
      
      // hinds :: wk1 :: pd1 :: weather
      $weath1 = new ScssClass();
      $weath1->setName('Weather');
      $weath1->setFaculty($manager->merge($this->getReference('hinds')));
      $weath1->setCourse($manager->merge($this->getReference('crs-weather')));
      $weath1->setDepartment($manager->merge($this->getReference('ch-nature')));
      $weath1->setPeriod($manager->merge($this->getReference('ch-w1-p1')));
      $manager->persist($weath1);
      $this->addReference('ch-w1-p1-cls-weather', $weath1);
      
      // hinds :: wk1 :: pd2 :: weather
      $weath2 = new ScssClass();
      $weath2->setName('Weather');
      $weath2->setFaculty($manager->merge($this->getReference('hinds')));
      $weath2->setCourse($manager->merge($this->getReference('crs-weather')));
      $weath2->setDepartment($manager->merge($this->getReference('ch-nature')));
      $weath2->setPeriod($manager->merge($this->getReference('ch-w1-p2')));
      $manager->persist($weath2);
      $this->addReference('ch-w1-p2-cls-weather', $weath2);
      
      // hinds :: wk1 :: pd3 :: weather
      $weath3 = new ScssClass();
      $weath3->setName('Weather');
      $weath3->setFaculty($manager->merge($this->getReference('hinds')));
      $weath3->setCourse($manager->merge($this->getReference('crs-weather')));
      $weath3->setDepartment($manager->merge($this->getReference('ch-nature')));
      $weath3->setPeriod($manager->merge($this->getReference('ch-w1-p3')));
      $manager->persist($weath3);
      $this->addReference('ch-w1-p3-cls-weather', $weath3);
    }
    
    public function getOrder() { return 13; }
  }
