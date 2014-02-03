<?php
namespace SCSS\OrganizationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\OrganizationBundle\Entity\Organization;

class LoadCouncilData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // BSA :: PTC
        $ptc = new Council();
        $ptc->setName('pine tree council');
        $ptc->setDescription('ptc');
        $ptc->setOrganization($this->getReference('org-bsa'));
        $manager->persist($ptc);
        $this->addReference('bsa-ptc', $ptc);

        // BSA :: KAC
        $kac = new Council();
        $kac->setName('katahdin area council');
        $kac->setDescription('kac');
        $kac->setOrganization($this->getReference('org-bsa'));
        $manager->persist($kac);
        $this->addReference('bsa-kac', $kac);

        // TEST :: CNCL
        $cncl = new Council();
        $cncl->setName('test council');
        $cncl->setDescription('cncl');
        $cncl->setOrganization($this->getReference('org-test'));
        $manager->persist($cncl);
        $this->addReference('council-test', $cncl);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
