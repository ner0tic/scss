<?php
namespace SCSS\GeographyBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use SCSS\GeographyBundle\Entity\Region;

class LoadRegionData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function load(ObjectManager $manager)
    {
        $geo = $this->container->get('ivory_google_map.geocoder');

        // BSA :: PTC :: cb
        $result = $geo->gecode('Portland Maine');
        $cb = new Region();
        $cb->setName('casco bay district');
        $cb->setOrganization($this->getReference('org-bsa'));
        $cb->setCouncil($this->getReference('bsa-ptc'));
        $cb->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $cb->setLogitude($result->getGeometry()->getLocation()->getLogitude());
        $manager->persist($cb);
        $this->setReference('ptc-cb', $cb);

        // BSA :: PTC :: yk
        $result = $geo->gecode('Alfred Maine');
        $yk = new Region();
        $yk->setName('york district');
        $yk->setOrganization($this->getReference('org-bsa'));
        $yk->setCouncil($this->getReference('bsa-ptc'));
        $yk->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $yk->setLogitude($result->getGeometry()->getLocation()->getLogitude());
        $manager->persist($yk);
        $this->setReference('ptc-yk', $yk);

        // BSA :: KAC :: AB
        $result = $geo->gecode('Bangor Maine');
        $ab = new Region();
        $ab->setName('aura borealis');
        $ab->setOrganization($this->getReference('org-bsa'));
        $ab->setCouncil($this->getReference('bsa-kac'));
        $ab->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $ab->setLogitude($result->getGeometry()->getLocation()->getLogitude());
        $manager->persist($ab);
        $this->setReference('kac-ab', $ab);

        // TEST :: TEST :: TEST
        $result = $geo->gecode('Boise Idaho');
        $test = new Region();
        $test->setName('casco bay district');
        $test->setOrganization($this->getReference('org-test'));
        $test->setCouncil($this->getReference('council-test'));
        $test->setLatitude($result->getGeometry()->getLocation()->getLatitude());
        $test->setLogitude($result->getGeometry()->getLocation()->getLogitude());
        $manager->persist($test);
        $this->setReference('region-test', $test);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
