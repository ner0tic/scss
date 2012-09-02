<?php
  namespace Scss\FacilityBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\FacilityBundle\Entity\Department;
  
  class LoadDepartmentData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camp Hinds - Waterfront
      $CH_H2o = new Department();
      $CH_H2o->setName('waterfront');
      $CH_H2o->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_H2o);
      
      // Camp Hinds - Main Beach
      $CH_MainBeach = new Department();
      $CH_MainBeach->setName('main beach');
      $CH_MainBeach->setParent($manager->merge($this->getReference('ch-waterfront')));
      $CH_MainBeach->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_MainBeach);             

      // Camp Hinds - West Beach
      $CH_WB = new Department();
      $CH_WB->setName('west beach');
      $CH_WB->setParent($manager->merge($this->getReference('ch-waterfront')));
      $CH_WB->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_WB);
      
      // Camp Hinds - Boating
      $CH_Boat = new Department();
      $CH_Boat->setName('boating');
      $CH_Boat->setParent($manager->merge($this->getReference('ch-waterfront')));
      $CH_Boat->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_Boat);       

      // Camp Hinds - ScoutCraft
      $CH_SC = new Department();
      $CH_SC->setName('scoutcraft');
      $CH_SC->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_SC);
      
      // Camp Hinds - Basic Scout Skills
      $CHG_BSS = new Department();
      $CHG_BSS->setName('basic scout skills');
      $CHG_BSS->setParent($manager->merge($this->getRefernce('ch-scoutcraft')));
      $CHG_BSS->setMaxOccupy('20');
      $CHG_BSS->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CHG_BSS);      
      
      // Camp Hinds - Nature Conservatory
      $CH_NC = new Department();
      $CH_NC->setName('nature conservatory');
      $CH_NC->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_NC);             

      // Camp Hinds - Shooting Sports
      $CH_SS = new Department();
      $CH_SS->setName('shooting sports');
      $CH_SS->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_SS);
      
      // Camp Hinds - Archery Range
      $CH_Arc = new Department();
      $CH_Arc->setName('archery range');
      $CH_Arc->setParent($manager->merge($this->getReference('ch-shooting')));
      $CH_Arc->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_Arc);      
      
      // Camp Hinds - Firing Range
      $CH_FR = new Department();
      $CH_FR->setName('firing range');
      $CH_FR->setParent($manager->merge($this->getReference('ch-shooting')));
      $CH_FR->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_FR);
      
      // Camp Hinds - Technology Center
      $CH_TC = new Department();
      $CH_TC->setName('technology center');
      $CH_TC->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_TC);             

      // Camp Hinds - COPE Tower
      $CH_CT = new Department();
      $CH_CT->setName('COPE tower');
      $CH_CT->setFacility($manager->merge($this->getReference('hinds')));
      $manager->persist($CH_CT);
      
      // Camp Hinds - Arts And Crafts
      $CH_Art = new Department();
      $CH_Art->setName('arts and crafts');
      $CH_Art->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_Art);
      
      // Camp Hinds - Other
      $CH_Oth = new Department();
      $CH_Oth->setName('other');
      $CH_Oth->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_Oth);
      
      // Camp Hinds - TBD
      $CH_TBD = new Department();
      $CH_TBD->setName('to be determined');
      $CH_TBD->setFacility($manager->merge($this->getReference('hinds')));      
      $manager->persist($CH_TBD);      
            
      // Camp Bomazeen - Waterfront
      $CB_WF = new Department();
      $CB_WF->setName('water front');
      $CB_WF->setFacility($manager->merge($this->getReference('bomazeen')));      
      $manager->persist($CH_WF);
      
      // Camp Bomazeen - Other
      $CB_Oth = new Department();
      $CB_Oth->setName('other');
      $CB_Oth->setFacility($manager->merge($this->getReference('bomazeen')));      
      $manager->persist($CB_Oth);
      
      // Camp Bomazeen - TBD
      $CB_TBD = new Department();
      $CB_TBD->setName('to be determined');
      $CB_TBD->setFacility($manager->merge($this->getReference('bomzeen')));      
      $manager->persist($CB_TBD);
      
      $manager->flush();
      
      $this->addReference('ch-waterfront',  $CH_H2o);
      $this->addReference('ch-h2o-main',    $CH_MainBeach);
      $this->addReference('ch-boat',        $CH_Boat);
      $this->addReference('ch-west',        $CH_WB);
      $this->addReference('ch-scoutcraft',  $CH_SC);
      $this->addReference('ch-bss',         $CH_BSS);
      $this->addReference('ch-cope',        $CH_CT);
      $this->addReference('ch-tech',        $CH_TC);
      $this->addReference('ch-shooting',    $CH_SS);
      $this->addReference('ch-archery',     $CH_Arc);
      $this->addReference('ch-rifle',       $CH_FR);
      $this->addReference('ch-nature',      $CH_NC);
      $this->addReference('ch-art',         $CH_Art);
      $this->addReference('ch-other',       $CH_Oth);
      $this->addReference('ch-tbd',         $CH_TBD);
      
      $this->addReference('cb-h2o',         $CB_WF);
      $this->addReference('cb-other',       $CB_Oth);
      $this->addReference('cb-tbd',         $CB_TBD);
    }
    
    public function getOrder() { return 4; }
  }
