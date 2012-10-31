<?php
  namespace Scss\FacilityBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\FacilityBundle\Entity\Quarters;
  
  class LoadQuartersData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camp Hinds :: Group - Baden Powell
      $CHG_BP = new Quarters();
      $CHG_BP->setName('baden powell campsite');
      $CHG_BP->setType('group');
      $CHG_BP->setMaxOccupy('20');
      $CHG_BP->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_BP); 
      $this->addReference('chg-bp', $CHG_BP);
      
      // Camp Hinds :: Group - Bailey
      $CHG_Bailey = new Quarters();
      $CHG_Bailey->setName('bailey campsite');
      $CHG_Bailey->setType('group');
      $CHG_Bailey->setMaxOccupy('20');
      $CHG_Bailey->setFacility($this->getReference('hinds'));
      $manager->persist($CHG_Bailey);      
      $this->addReference('chg-bailey', $CHG_Bailey);
      
      // Camp Hinds :: Group - Brownsea
      $CHG_BS = new Quarters();
      $CHG_BS->setName('brownsea campsite');
      $CHG_BS->setType('group');
      $CHG_BS->setMaxOccupy('20');
      $CHG_BS->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_BS);    
      $this->addReference('chg-bs', $CHG_BS);
      
      // Camp Hinds :: Group - Byrd
      $CHG_Byrd = new Quarters();
      $CHG_Byrd->setName('byrd campsite');
      $CHG_Byrd->setType('group');
      $CHG_Byrd->setMaxOccupy('20');
      $CHG_Byrd->setFacility($this->getReference('hinds'));
      $manager->persist($CHG_Byrd);
      $this->addReference('chg-byrd', $CHG_Byrd);
      
      // Camp Hinds :: Group - Dan Beard
      $CHG_DB = new Quarters();
      $CHG_DB->setName('dan beard campsite');
      $CHG_DB->setType('group');
      $CHG_DB->setMaxOccupy('20');
      $CHG_DB->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_DB);
      $this->addReference('chg-db', $CHG_DB);
      
      // Camp Hinds :: Group - MacMillan
      $CHG_MM = new Quarters();
      $CHG_MM->setName('macmillan campsite');
      $CHG_MM->setType('group');
      $CHG_MM->setMaxOccupy('20');
      $CHG_MM->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_MM);
      $this->addReference('chg-mm', $CHG_MM);
      
      // Camp Hinds :: Group - Mcguire
      $CHG_McG = new Quarters();
      $CHG_McG->setName('mcguire campsite');
      $CHG_McG->setType('group');
      $CHG_McG->setMaxOccupy('20');
      $CHG_McG->setFacility($this->getReference('hinds'));
      $manager->persist($CHG_McG);
      $this->addReference('chg-mcg', $CHG_McG);
      
      // Camp Hinds :: Group - Patrick
      $CHG_Pat = new Quarters();
      $CHG_Pat->setName('patrick campsite');
      $CHG_Pat->setType('group');
      $CHG_Pat->setMaxOccupy('20');
      $CHG_Pat->setFacility($this->getReference('hinds'));
      $manager->persist($CHG_Pat);
      $this->addReference('chg-pat', $CHG_Pat);
      
      // Camp Hinds :: Group - Pershing
      $CHG_Per = new Quarters();
      $CHG_Per->setName('pershing campsite');
      $CHG_Per->setType('group');
      $CHG_Per->setMaxOccupy('20');
      $CHG_Per->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_Per);  
      $this->addReference('chg-per', $CHG_Per);
            
      // Camp Hinds :: Group - Ridgway
      $CHG_RW = new Quarters();
      $CHG_RW->setName('ridgway campsite');
      $CHG_RW->setType('group');
      $CHG_RW->setMaxOccupy('20');
      $CHG_RW->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_RW); 
      $this->addReference('chg-rw', $CHG_RW);
      
      // Camp Hinds :: Group - Tenny
      $CHG_Tenny = new Quarters();
      $CHG_Tenny->setName('tenny campsite');
      $CHG_Tenny->setType('group');
      $CHG_Tenny->setMaxOccupy('20');
      $CHG_Tenny->setFacility($this->getReference('hinds'));
      $manager->persist($CHG_Tenny);
      $this->addReference('chg-tenny', $CHG_Tenny);
      
      // Camp Hinds :: Group - West
      $CHG_West = new Quarters();
      $CHG_West->setName('west campsite');
      $CHG_West->setType('group');
      $CHG_West->setMaxOccupy('20');
      $CHG_West->setFacility($this->getReference('hinds'));      
      $manager->persist($CHG_West);
      $this->addReference('chg-west', $CHG_West);
      
      // Camp Hinds :: Group - Wilderness
      $CHG_Wild = new Quarters();
      $CHG_Wild->setName('mcguire campsite');
      $CHG_Wild->setType('group');
      $CHG_Wild->setMaxOccupy('35');
      $CHG_Wild->setFacility($this->getReference('hinds'));
      $manager->persist($CHG_Wild);
      $this->addReference('chg-wild', $CHG_Wild);
      
      // Camp Hinds :: Faculty - Pershing
      $CHF_Per = new Quarters();
      $CHF_Per->setName('pershing cabin');
      $CHF_Per->setType('group');
      $CHF_Per->setMaxOccupy('4');
      $CHF_Per->setFacility($this->getReference('hinds'));
      $manager->persist($CHF_Per); 
      $this->addReference('chf-per', $CHF_Per);
      
      // Camp Hinds :: Faculty - Shady Acres
      $CHF_SA = new Quarters();
      $CHF_SA->setName('shady acres cabin');
      $CHF_SA->setType('group');
      $CHF_SA->setMaxOccupy('4');
      $CHF_SA->setFacility($this->getReference('hinds'));
      $manager->persist($CHF_SA); 
      $this->addReference('chf-sa', $CHF_SA);
      
      $manager->flush();
    }
    
    public function getOrder() { return 7; }
  }