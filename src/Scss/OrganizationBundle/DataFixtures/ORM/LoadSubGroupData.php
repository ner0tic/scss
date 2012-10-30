<?php
  namespace Scss\OrganizaitonBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\OrganizationBundle\Entity\SubGroup;
  
  class LoadSubGroupData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // cb805 :: bears
      $bears805 = new SubGroup();
      $bears805->setName('bears');
      $bears805->setGroup($manager->merge($this->getReference('cb-805')));
      $manager->persist($bears805);
      $this->addReference('cb805-bears', $bears805);
      
      // fl500 :: foxes
      $fox500 = new SubGroup();
      $fox500->setName('foxes');
      $fox500->setGroup($manager->merge($this->getReference('fl-500')));
      $manager->persist($fox500);
      $this->addReference('fl500-foxes', $fox500);
    }
    
    public function getOrder() { return 16; }
  }
