<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Course;
  
  class LoadCourseData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camping
      $CAM = new Course();
      $CAM->setName('Camping');
      $CAM->setMeritbadge($manager->merge($this->getReference('mb-camping')));
      $CAM->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CAM);
      
      // Backpacking
      $BKPK = new Course();
      $BKPK->setName('Backpacking');
      $BKPK->setMeritbadge($manager->merge($this->getReference('mb-backpacking')));
      $BKPK->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($BKPK);
      $this->addReference('crs-backpacking', $BKPK);
      
      // Swimming
      $SWIMMING = new Course();
      $SWIMMING->setName('swimming');
      $SWIMMING->setMeritbadge($manager->merge($this->getReference('mb-swimming')));
      $SWIMMING->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($SWIMMING);
      $this->addReference('crs-swimming', $SWIMMING);
      
      // MotorBoating
      $MOTORBOAT = new Course();
      $MOTORBOAT->setName('motorboat');
      $MOTORBOAT->setMeritbadge($manager->merge($this->getReference('mb-motorboating')));
      $MOTORBOAT->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($MOTORBOAT);
      $this->addReference('crs-motorboating', $MOTORBOAT);
      
      // Fishing
      $FISHING = new Course();
      $FISHING->setName('fishing');
      $FISHING->setMeritbadge($manager->merge($this->getReference('mb-fishing')));
      $FISHING->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($FISHING);
      $this->addReference('crs-fishing', $FISHING);
      
      // First aid
      $FIRSTAID = new Course();
      $FIRSTAID->setName('first aid');
      $FIRSTAID->setSpecial(true);
      $FIRSTAID->setMeritbadge($manager->merge($this->getReference('mb-firstaid')));
      $FIRSTAID->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($FIRSTAID);
      $this->addReference('crs-firstaid', $FIRSTAID);
      
      // Computers
      $COMPUTER = new Course();
      $COMPUTER->setName('computers');
      $COMPUTER->setMeritbadge($manager->merge($this->getReference('mb-computers')));
      $COMPUTER->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($COMPUTER);
      $this->addReference('crs-computers', $COMPUTER);
      
      // Weather
      $WEATHER = new Course();
      $WEATHER->setName('weather');
      $WEATHER->setMeritbadge($manager->merge($this->getReference('mb-weather')));
      $WEATHER->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($WEATHER);
      $this->addReference('crs-weather', $WEATHER);
      
      // Climbing
      $CLIMBING = new Course();
      $CLIMBING->setName('climbing');
      $CLIMBING->setMeritbadge($manager->merge($this->getReference('mb-climbing')));
      $CLIMBING->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CLIMBING);
      $this->addReference('crs-climbing', $CLIMBING);
      
      // Archery
      $ARCHERY = new Course();
      $ARCHERY->setName('archery');
      $ARCHERY->setMeritbadge($manager->merge($this->getReference('mb-archery')));
      $ARCHERY->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($ARCHERY);
      $this->addReference('crs-archery', $ARCHERY);
      
      // Shotgun
      $SHOTGUN = new Course();
      $SHOTGUN->setName('shotgun shooting');
      $SHOTGUN->setMeritbadge($manager->merge($this->getReference('mb-shotgun')));
      $SHOTGUN->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($SHOTGUN);
      $this->addReference('crs-shotgun', $SHOTGUN);
      
      // Lifesaving
      $LIFESAVING = new Course();
      $LIFESAVING->setName('lifesaving');
      $LIFESAVING->setSpecial(true);
      $LIFESAVING->setMeritbadge($manager->merge($this->getReference('mb-lifesaving')));
      $LIFESAVING->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($LIFESAVING);
      $this->addReference('crs-lifesaving', $LIFESAVING);
      
      $manager->flush();
    }
    
    public function getOrder() { return 10; }
  }
