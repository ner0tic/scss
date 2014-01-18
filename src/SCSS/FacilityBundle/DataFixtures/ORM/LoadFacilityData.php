<?php
namespace SCSS\FacilityBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use SCSS\FacilityBundle\Entity\Facility;

class LoadFacilityData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $hinds = new Facility();
        $hinds->setName('william hinds');
        $hinds->setAddress($this->getReference('address-facility-hinds'));
        $hinds->setOrganization($this->getReference('org-bsa'));
        $hinds->setCouncil($this->getReference('council-bsa-ptc'));
        $hinds->setRegion($this->getReference('ptc-cb'));
        $hinds->setFaction($this->getReference('faction-t805-bears'));
        $hinds->setPassel($this->getReference('passel-t805'));
        $manager->persist($hinds);
        $this->addReference('facility-t805-hinds');

        $ndurost = new Facility();
        $ndurost->setFirstName('nick');
        $ndurost->setLastName('durost');
        $ndurost->setUsername('ndurost');
        $ndurost->setPassword('p4s5w0r2');
        $ndurost->setEmail('nick@daviddurost.net');
        $ndurost->setFaction($this->getReference('faction-t805-bears'));
        $ndurost->setPassel($this->getReference('passel-t805'));
        $manager->persist($ndurost);
        $this->addReference('facility-t805-ndurost');

        $manager->flush();
    }

    public function getOrder()
    {
        return 13;
    }
}
