<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Position;

class LoadPositionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // T805 :: faction leader
        $fl = new Position();
        $fl->setName('patrol leader');
        $fl->setAvatar('default.png');
        $fl->setPassel($this->getReference('bsa-troop-805'));
        $manager->persist($position);
        $this->addReference('troop-805-position', $fl);

        // T805 :: Pirates
        $pirates = new position();
        $pirates->setName('pirates');
        $pirates->setAvatar('default.png');
        $pirates->setPassel($this->getReference('bsa-troop-805'));
        $manager->persist($pirates);
        $this->addReference('troop-805-pirates', $pirates);

        // Test Passel :: Test Position
        $test = new position();
        $test->setName('test position');
        $test->setAvatar('default.png');
        $this->setPassel($this->getReference('passel-test'));
        $manager->persist($test);
        $this->addReference('position-test', $test);

        $manager->flush();
    }

    public function getOrder() 
    { 
        return 6; 
    }
}