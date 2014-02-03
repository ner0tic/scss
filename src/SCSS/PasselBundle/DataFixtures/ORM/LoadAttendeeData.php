<?php
namespace SCSS\PasselBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\PasselBundle\Entity\Attendee;

class LoadAttendeeData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $mgosselin = new Attendee();
        $mgosselin->setFirstName('mike');
        $mgosselin->setLastName('gosselin');
        $mgosselin->setUsername('mike.gosselin');
        $mgosselin->setPassword('p4s5w0r2');
        $mgosselin->setEmail('temp@daviddurost.net');
        $mgosselin->setFaction($this->getReference('faction-t805-bears'));
        $mgosselin->setPassel($this->getReference('passel-t805'));
        $manager->persist($mgosselin);
        $this->addReference('attendee-t805-mgosselin');

        $ndurost = new Attendee();
        $ndurost->setFirstName('nick');
        $ndurost->setLastName('durost');
        $ndurost->setUsername('ndurost');
        $ndurost->setPassword('p4s5w0r2');
        $ndurost->setEmail('ner0tic@daviddurost.net');
        $ndurost->setFaction($this->getReference('faction-t805-bears'));
        $ndurost->setPassel($this->getReference('passel-t805'));
        $manager->persist($ndurost);
        $this->addReference('attendee-t805-ndurost');

        $manager->flush();
    }

    public function getOrder()
    {
        return 12;
    }
}
