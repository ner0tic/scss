<?php
namespace SCSS\OrganizationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\OrganizationBundle\Entity\Organization;

class LoadOrganizationData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bsa = new Organization();
        $bsa->setName('boy scouts of america');
        $test->setDescription('boy scouts');
        $manager->persist($bsa);
        $this->addReference('bsa');

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
