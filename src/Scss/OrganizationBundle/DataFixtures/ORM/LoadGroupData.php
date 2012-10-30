<?php
  namespace Scss\OrganizationBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\OrganizationBundle\Entity\ScssGroup;
  
  class LoadGroupData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // cb805
      $cb805 = new ScssGroup();
      $cb805->setName('Troop 805');
      $cb805->setRegion($manager->merge($this->getReference('casco-bay')));
      $manager->persist($cb805);
      $this->addReference('cb-805', $cb805);
      
      // fl500
      $fl500 = new ScssGroup();
      $fl500->setName('Troop 500');
      $fl500->setRegion($manager->merge($this->getReference('flintlock')));
      $manager->persist($fl500);
      $this->addReference('fl-500', $fl500);
    }
    
    public function getOrder() { return 14; }
  }
