<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Requirement;
  
  class LoadRequirementData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camping - 1
      $CAMPING_1 = new Requirement();
      $CAMPING_1->setName('1');
      $CAMPING_1->setText('Show that you know first aid for and how to prevent injuries or illnesses that could occur while camping, including hypothermia, frostbite, heat reactions, dehydration, altitude sickness, insect stings, tick bites, snakebite, blisters, and hyperventilation.');
      $CAMPING_1->setMeritBadge($manager->merge($this->getReference('camping')));      
      $manager->persist($CAMPING_1); 
      $this->addReference('camping-1', $CAMPING_1);
      
      // Camping - 2
      $CAMPING_2 = new Requirement();
      $CAMPING_2->setName('2');
      $CAMPING_2->setText('Learn the Leave No Trace principles and the Outdoor Code and explain what they mean. Write a personal plan for implementing these principles on your next outing.');
      $CAMPING_2->setMeritBadge($manager->merge($this->getReference('camping')));
      $manager->persist($CAMPING_2);      
      $this->addReference('camping-2', $CAMPING_2);
      
      // Camping - 3
      $CAMPING_3 = new Requirement();
      $CAMPING_3->setName('3');
      $CAMPING_3->setText('Make a written plan for an overnight trek and show how to get to your camping spot using a topographical map and compass OR a topographical map and a GPS receiver.');
      $CAMPING_3->setMeritBadge($manager->merge($this->getReference('camping')));      
      $manager->persist($CAMPING_3); 
      $this->addReference('camping-3', $CAMPING_3);
      
      // Camping - 4
      $CAMPING_4 = new Requirement();
      $CAMPING_4->setName('4');
      $CAMPING_4->setText('Do the following:');
      $CAMPING_4->setMeritBadge($manager->merge($this->getReference('camping')));
      $manager->persist($CAMPING_4);      
      $this->addReference('camping-4', $CAMPING_4);
      
      // Camping - 4a
      $CAMPING_4a = new Requirement();
      $CAMPING_4a->setName('4a');
      $CAMPING_4a->setText('Make a duty roster showing how your patrol is organized for an actual overnight campout. List assignments for each member.');
      $CAMPING_4a->setMeritBadge($manager->merge($this->getReference('camping')));      
      $CAMPING_4b->setParent($manager->merge($this->getReference('camping-4')));
      $manager->persist($CAMPING_4a); 
      $this->addReference('camping-4a', $CAMPING_4a);
      
      // Camping - 4b
      $CAMPING_4b = new Requirement();
      $CAMPING_4b->setName('4b');
      $CAMPING_4b->setText('Help a Scout patrol or a Webelos Scout unit in your area prepare for an actual campout, including creating the duty roster, menu planning, equipment needs, general planning, and setting up camp.');
      $CAMPING_4b->setMeritBadge($manager->merge($this->getReference('camping')));
      $CAMPING_4b->setParent($manager->merge($this->getReference('camping-4')));
      $manager->persist($CAMPING_4b);      
      $this->addReference('camping-4b', $CAMPING_4b);
    }
    
    public function getOrder() { return 12; }
  }