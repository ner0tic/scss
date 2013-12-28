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
        // T805 :: Bears
        $bears = new position();
        $bears->setName('bears');
        $bears->setAvatar('default.png');
        $bears->setPassel($this->getReference('bsa-troop-805'));
        $manager->persist($bears);
        $this->addReference('troop-805-bears', $bears);

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