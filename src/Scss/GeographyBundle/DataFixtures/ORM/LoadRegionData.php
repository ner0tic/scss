<?php
  namespace Scss\GeographyBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Symfony\Component\DependencyInjection\ContainerAwareInterface;
  use Symfony\Component\DependencyInjection\ContainerInterface;
  use Scss\GeographyBundle\Entity\Region;
  
  abstract class LoadRegionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    private $container;
    
    public function setContainer(ContainerInterface $container = null) { $this->container = $container; }
    
    public function load(ObjectManager $manager) {
      $geo = $this->container->get('ivory_google_map.geocoder');
      
      // Abanaki District
      $result = $geo->geocode('Oxford Maine');
      $AB = new Region();
      $AB->setName('abanaki district');
      $AB->setOrganization($manager->merge($this->getReference('ptc-bsa')));
      $AB->setLatitude($result->getGeometry()->getLocation()->getLatitude());
      $AB->setLogitude($result->getGeometry()->getLocation()->getLogitude());
      $manager->persist($AB);
      $this->addReference('abanaki',         $AB);
      
      // Casco Bay District
      $result = $geo->gecode('Portland Maine');
      $CB = new Region();
      $CB->setName('casco bay district');
      $CB->setIsoCode('CB');
      $CB->setOrganization($manager->merge($this->getRegerence('ptc-bsa')));
      $CB->setLatitude($result->getGeometry()->getLocation()->getLatitude());
      $CB->setLogitude($result->getGeometry()->getLocation()->getLogitude());
      $manager->persist($CB); 
      $this->setReference('casco-bay', $CB);
      
      // Flintlock District
      $result = $geo->gecode('Woburn Massachusetts');
      $FL = new Region();
      $FL->setName('flintlock district');
      $FL->setIsoCode('FL');
      $FL->setOrganization($manager->merge($this->getRegerence('mmc-bsa')));
      $FL->setLatitude($result->getGeometry()->getLocation()->getLatitude());
      $FL->setLogitude($result->getGeometry()->getLocation()->getLogitude());
      $manager->persist($FL); 
      $this->setReference('flintlock', $FL);
    }
    
    public function getOrder() { return 3; }
  }