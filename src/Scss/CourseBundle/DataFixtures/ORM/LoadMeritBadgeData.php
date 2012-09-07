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
      $this->addReference('camping', $CAMPING);
      
      // Backpacking
      $BACKPACKING = new MeritBadge();
      $BACKPACKING->setName('backpacking');
      $manager->persist($BACKPACKING);      
      $this->addReference('backpacking', $BACKPACKING);
      
      // Swimming
      $SWIMMING = new MeritBadge();
      $SWIMMING->setName('swimming');
      $manager->persist($SWIMMING);
      $this->addReference('swimming', $SWIMMING);
      
      // MotorBoating
      $MOTORBOAT = new MeritBadge();
      $MOTORBOAT->setName('motorboat');
      $manager->persist($MOTORBOAT);
      $this->addReference('motorboating', $MOTORBOAT);
      
      // Fishing
      $FISHING = new MeritBadge();
      $FISHING->setName('fishing');
      $manager->persist($FISHING);
      $this->addReference('fishing', $FISHING);
      
      // First aid
      $FIRSTAID = new MeritBadge();
      $FIRSTAID->setName('first aid');
      $FIRSTAID->setSpecial(true);
      $manager->persist($FIRSTAID);
      $this->addReference('firstaid', $FIRSTAID);
      
      // Computers
      $COMPUTER = new MeritBadge();
      $COMPUTER->setName('computers');
      $manager->persist($COMPUTER);
      $this->addReference('comptuers', $COMPUTER);
      
      // Weather
      $WEATHER = new MeritBadge();
      $WEATHER->setName('weather');
      $manager->persist($WEATHER);
      $this->addReference('weather', $WEATHER);
      
      // Climbing
      $CLIMBING = new MeritBadge();
      $CLIMBING->setName('climbing');
      $manager->persist($CLIMBING);
      $this->addReference('climbing', $CLIMBING);
      
      // Archery
      $ARCHERY = new MeritBadge();
      $ARCHERY->setName('archery');
      $manager->persist($ARCHERY);
      $this->addReference('archery', $ARCHERY);
      
      // Shotgun
      $SHOTGUN = new MeritBadge();
      $SHOTGUN->setName('shotgun shooting');
      $manager->persist($SHOTGUN);
      $this->addReference('shotgun', $SHOTGUN);
      
      // Lifesaving
      $LIFESAVING = new MeritBadge();
      $LIFESAVING->setName('lifesaving');
      $LIFESAVING->setSpecial(true);
      $manager->persist($LIFESAVING);
      $this->addReference('lifesaving', $LIFESAVING);
    }
    
    public function getOrder() { return 11; }
  }