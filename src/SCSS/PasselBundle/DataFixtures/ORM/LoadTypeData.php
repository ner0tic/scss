<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Type;

class LoadTypeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Passel Type :: Troop
        $troop = new Type();
        $troop->setName('troop');
        $troop->setDescription('boy scout troop');
        $troop->setOrganization($this->getReference('org-bsa'));
        $manager->persist($troop);
        $this->addReference('passel-type-troop', $troop);

        // Passel Type :: Test
        $test = new Type();
        $test->setName('test');
        $test->setDescription('test type');
        $test->setOrganization($this->getReference('org-test'));
        $manager->persist($test);
        $this->addReference('passel-type-test', $test);

        $manager->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}
