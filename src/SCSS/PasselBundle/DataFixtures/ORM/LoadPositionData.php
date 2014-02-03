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
        // Position :: BSA :: patrol leader
        $apl = new Position();
        $apl->setName('patrol leader');
        $apl->setDescription('patrol leader');
        $apl->setOrganization($this->getReference('org-bsa'));
        $manager->persist($apl);
        $this->addReference('passel-position-bsa-pl', $apl);

        // Position :: BSA :: assistant patrol leader
        $apl = new Position();
        $apl->setName('assistant patrol leader');
        $apl->setDescription('assistant patrol leader');
        $apl->setOrganization($this->getReference('org-bsa'));
        $manager->persist($position);
        $this->addReference('passel-position-bsa-apl', $apl);

        $manager->aplush();
    }

    public function getOrder()
    {
        return 10;
    }
}
