<?php
  namespace Scss\OrganizationBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\OrganizationBundle\Entity\GroupLeader;
  
  class LoadGroupLeaderData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // fl500 :: matt farmer
      $mattfarmer = new GroupLeader();
      $mattfarmer->setFirstName('Matt');
      $mattfarmer->setLastName('Farmer');
      $mattfarmer->getBirthdate('1983-04-10 00:00:00');
      $mattfarmer->setGroup($this->getReference('fl-500'));
      $manager->persist($mattfarmer);
      $this->addReference('fl500-mattfarmer', $mattfarmer);
      
      // cb805 :: matt gosselin
      $mattg = new GroupLeader();
      $mattg->setFirstName('Matt');
      $mattg->setLastName('gosselin');
      $mattg->getBirthdate('1983-07-10 00:00:00');
      $mattg->setGroup($this->getReference('cb-805'));
      $manager->persist($mattg);
      $this->addReference('cb805-mattg', $mattg);
      
      $manager->flush();
    }
    
    public function getOrder() { return 15; }
  }
