<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Level;

class LoadLevelData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Level ::  BSA :: Basic
        $basic = new Level();
        $basic->setName('basic');
        $basic->setDescription('basic scout');
        $basic->setsetOrganization($this->getReference('org-bsa'));
        $manager->persist($basic);
        $this->addReference('bsa-basic', $basic);

        // Level ::  BSA :: Eagle
        $eagle = new Level();
        $eagle->setName('eagle');
        $eagle->setDescription('eagle scout');
        $eagle->setsetOrganization($this->getReference('org-bsa'));
        $eagle->isSpecial(true);
        $manager->persist($eagle);
        $this->addReference('bsa-eagle', $eagle);

        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}
