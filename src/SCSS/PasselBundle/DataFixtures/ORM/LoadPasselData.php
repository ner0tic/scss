<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Passel;

class LoadPasselData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Passel :: T805
        $t805 = new Passel();
        $t805->setName('805');
        $t805->setCouncil($this->getReference('bsa-ptc'));
        $t805->setRegion($this->getReference('ptc-cb'));
        $t805->setType($this->getReference('passel-type-troop'));
        $manager->persist($t805);
        $this->addReference('passel-t805', $t805);

        // Passel :: Test
        $test = new Passel();
        $test->setName('test');
        $test->setCouncil($this->getReference('council-test'));
        $test->setRegion($this->getReference('region-test'));
        $test->setType($this->getReference('passel-type-test'));
        $manager->persist($test);
        $this->addReference('passel-test', $test);

        $manager->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}
