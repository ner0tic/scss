<?php
  namespace Scss\FacilityBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Week;
  
  class LoadWeekData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // Camp Hinds :: Week 1 - TTE
      $CH_W1 = new Week();
      $CH_W1->setName('week 1');
      $CH_W1->setStart(new \DateTime('2013-06-30 00:00:00')  );
      $CH_W1->setEnd($CH_W1->getStart().'+5 DAY');
      $CH_W1->setFacility($this->getReference('hinds')); 
      $CH_W1->setSpecial(true);
      $manager->persist($CH_W1); 
      $this->addReference('ch-w1', $CH_W1);
      
      // Camp Hinds :: Week 2
      $CH_W2 = new Week();
      $CH_W2->setName('week 2');
      $CH_W2->setStart(new \DateTime('2013-07-07 00:00:00')  );
      $CH_W2->setEnd($CH_W2->getStart().'+5 DAY');
      $CH_W2->setFacility($this->getReference('hinds'));
      $manager->persist($CH_W2);      
      $this->addReference('ch-w2', $CH_W2);
      
      // Camp Hinds :: Week 3
      $CH_W3 = new Week();
      $CH_W3->setName('week 3');
      $CH_W3->setStart(new \DateTime('2013-07-14 00:00:00')  );
      $CH_W3->setEnd($CH_W3->getStart().'+5 DAY');
      $CH_W3->setFacility($this->getReference('hinds')); 
      $manager->persist($CH_W3); 
      $this->addReference('ch-w3', $CH_W3);
      
      // Camp Hinds :: Week 4
      $CH_W4 = new Week();
      $CH_W4->setName('week 4');
      $CH_W4->setStart(new \DateTime('2013-07-21 00:00:00')  );
      $CH_W4->setEnd($CH_W4->getStart().'+5 DAY');
      $CH_W4->setFacility($this->getReference('hinds'));
      $manager->persist($CH_W4);      
      $this->addReference('ch-w4', $CH_W4);      
      
      // Camp Hinds :: Week 5
      $CH_W5 = new Week();
      $CH_W5->setName('week 5');
      $CH_W5->setStart(new \DateTime('2013-07-28 00:00:00')  );
      $CH_W5->setEnd($CH_W5->getStart().'+5 DAY');
      $CH_W5->setFacility($this->getReference('hinds')); 
      $manager->persist($CH_W5); 
      $this->addReference('ch-w5', $CH_W5);
      
      // Camp Hinds :: Week 6
      $CH_W6 = new Week();
      $CH_W6->setName('week 6');
      $CH_W6->setStart(new \DateTime('2013-08-04 00:00:00')  );
      $CH_W6->setEnd($CH_W6->getStart().'+5 DAY');
      $CH_W6->setFacility($this->getReference('hinds'));
      $manager->persist($CH_W6);      
      $this->addReference('ch-w6', $CH_W6);
    
      // Camp Hinds :: Week 7 - TTE
      $CH_W7 = new Week();
      $CH_W7->setName('week 7');
      $CH_W7->setStart(new \DateTime('2013-08-11 00:00:00')  );
      $CH_W7->setEnd($CH_W7->getStart().'+5 DAY');
      $CH_W7->setFacility($this->getReference('hinds')); 
      $CH_W7->setSpecial(true);
      $manager->persist($CH_W7); 
      $this->addReference('ch-w7', $CH_W7);
      
      $manager->flush();
    }
    
    public function getOrder() { return 11; }    
  }