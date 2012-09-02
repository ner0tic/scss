<?php
  namespace Scss\OrganizationBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Symfony\Component\DependencyInjection\ContainerAwareInterface;
  use Symfony\Component\DependencyInjection\ContainerInterface;  
  use Scss\OrganizationBundle\Entity\Organization;
  
  class LoadOrganizationData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    public function load(ObjectManager $manager) {
      // Pine Tree Council
      $PTC = new Organization();
      $PTC->setName('pine tree council');
      $PTC->setCode('PTC-BSA');
      $PTC->setZone('Maine');
      $PTC->setCountry('United States');
      $manager->persist($PTC);
      $this->addReference('ptc-bsa',         $PTC);
      
      // Kitahdin Area Council
      $KAC = new Organization();
      $KAC->setName('kitahdin area council');
      $KAC->setCode('KAC-BSA');
      $KAC->setZone('Maine');
      $KAC->setCountry('United States');
      $manager->persist($KAC); 
      $this->addReference('kac-bsa',         $KAC);
    }
    
    public function getOrder() { return 1; }
  }