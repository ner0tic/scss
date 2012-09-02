<?php
  namespace Scss\FacilityBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\FacilityBundle\Entity\Facility;
  
  class LoadFacilityData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camp Hinds
      $Hinds = new Facility();
      $Hinds->setName('hinds');
      $Hinds->setPhone('2077664748');
      $Hinds->setEmail('info@camphindsbsa.org');
      $manager->persist($Hinds);
      $this->addReference('hinds', $Hinds);
      
      // Camp Bomazeen
      $Bom = new Facility();
      $Bom->setName('bomazeen');
      $Bom->setPhone('123456789');
      $Bom->setEmail('info@campbomazeenbsa.org');
      $manager->persist($Bom);             
      $this->addReference('bomazeen', $Bom);
      
      $manager->flush();
    }
    
    public function getOrder() { return 3; }
  }
