<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\MeritBadge;
  
  class LoadMeritBadgeData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camping
      $CAMPING = new MeritBadge();
      $CAMPING->setName('camping');
      $CAMPING->setSpecial(true);
      $manager->persist($CAMPING); 
      $this->addReference('mb-camping', $CAMPING);
      
      // Backpacking
      $BACKPACKING = new MeritBadge();
      $BACKPACKING->setName('backpacking');
      $manager->persist($BACKPACKING);      
      $this->addReference('mb-backpacking', $BACKPACKING);
      
      // Swimming
      $SWIMMING = new MeritBadge();
      $SWIMMING->setName('swimming');
      $manager->persist($SWIMMING);
      $this->addReference('mb-swimming', $SWIMMING);
      
      // MotorBoating
      $MOTORBOAT = new MeritBadge();
      $MOTORBOAT->setName('motorboat');
      $manager->persist($MOTORBOAT);
      $this->addReference('mb-motorboating', $MOTORBOAT);
      
      // Fishing
      $FISHING = new MeritBadge();
      $FISHING->setName('fishing');
      $manager->persist($FISHING);
      $this->addReference('mb-fishing', $FISHING);
      
      // First aid
      $FIRSTAID = new MeritBadge();
      $FIRSTAID->setName('first aid');
      $FIRSTAID->setSpecial(true);
      $manager->persist($FIRSTAID);
      $this->addReference('mb-firstaid', $FIRSTAID);
      
      // Computers
      $COMPUTER = new MeritBadge();
      $COMPUTER->setName('computers');
      $manager->persist($COMPUTER);
      $this->addReference('mb-computers', $COMPUTER);
      
      // Weather
      $WEATHER = new MeritBadge();
      $WEATHER->setName('weather');
      $manager->persist($WEATHER);
      $this->addReference('mb-weather', $WEATHER);
      
      // Climbing
      $CLIMBING = new MeritBadge();
      $CLIMBING->setName('climbing');
      $manager->persist($CLIMBING);
      $this->addReference('mb-climbing', $CLIMBING);
      
      // Archery
      $ARCHERY = new MeritBadge();
      $ARCHERY->setName('archery');
      $manager->persist($ARCHERY);
      $this->addReference('mb-archery', $ARCHERY);
      
      // Shotgun
      $SHOTGUN = new MeritBadge();
      $SHOTGUN->setName('shotgun shooting');
      $manager->persist($SHOTGUN);
      $this->addReference('mb-shotgun', $SHOTGUN);
      
      // Lifesaving
      $LIFESAVING = new MeritBadge();
      $LIFESAVING->setName('lifesaving');
      $LIFESAVING->setSpecial(true);
      $manager->persist($LIFESAVING);
      $this->addReference('mb-lifesaving', $LIFESAVING);
    }
    
    public function getOrder() { return 9; }
  }