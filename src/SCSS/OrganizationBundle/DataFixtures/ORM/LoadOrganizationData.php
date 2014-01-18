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
        // BSA
        $bsa = new Organization();
        $bsa->setName('boy scouts of america');
        $bsa->setDescription('boy scouts');
        $manager->persist($bsa);
        $this->addReference('org-bsa', $bsa);

        // Test Org
        $test = new Organization();
        $test->setName('test organization');
        $test->setDescription('test data');
        $manager->persist($test);
        $this->addReference(
            'org-test',
            $test
        );

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
