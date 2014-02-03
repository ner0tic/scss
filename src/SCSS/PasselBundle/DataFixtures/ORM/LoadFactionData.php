<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Faction;

class LoadFactionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // T805 :: Bears
        $bears = new Faction();
        $bears->setName('bears');
        $bears->setAvatar('default.png');
        $bears->setPassel($this->getReference('bsa-troop-805'));
        $manager->persist($bears);
        $this->addReference('faction-t805-bears', $bears);

        // T805 :: Pirates
        $pirates = new Faction();
        $pirates->setName('pirates');
        $pirates->setAvatar('default.png');
        $pirates->setPassel($this->getReference('bsa-troop-805'));
        $manager->persist($pirates);
        $this->addReference('faction-t805-pirates', $pirates);

        $manager->flush();
    }

    public function getOrder()
    {
        return 11;
    }
}
