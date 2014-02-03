<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Leader;

class LoadLeaderData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Leader :: MGosselin
        $mgosselin = new Leader();
        $mgosselin->setUsername('mgosselin');
        $mgosselin->setPassword('p4s5w0r2');
        $mgosselin->setEmail('ner0tic@daviddurost.net');
        $mgosselin->setFirstName('matt');
        $mgosselin->setLastName('gosselin');
        $mgosselin->setPassel($this->getReference('passel-t805'));
        $mgosselin->isAdmin(true);
        $manager->persist($mgosselin);
        $this->addReference('leader-t805-mgosselin', $mgosselin);

        $manager->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}
