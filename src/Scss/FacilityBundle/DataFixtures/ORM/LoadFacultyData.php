<?php
  namespace Scss\FacilityBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\FacilityBundle\Entity\Faculty;
  
  class LoadFacultyData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      $nickDurost = new Faculty();
      $nickDurost->setFirstName('Nick');
      $nickDurost->setLastName('Durost');
      $nickDurost->setBirthdate(new \DateTime('1988-03-17 00:00:00'));
      $nickDurost->setFacility($this->getReference('hinds'));
      $nickDurost->setQuarters($this->getReference('chf-per'));
      $nickDurost->setTitle('Aquatics Instructor');
      $manager->persist($nickDurost);
      $this->addReference('ch-faculty-nickdurost', $nickDurost);
      
      $manager->flush();
    }
    
    public function getOrder() { return 8; }
  }
