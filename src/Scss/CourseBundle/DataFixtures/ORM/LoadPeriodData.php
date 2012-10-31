<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Period;
  
  abstract class LoadPeriodData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      // hinds :: week 1 - period 1
      $H_WK1_P1 = new Period();
      $H_WK1_P1->setName('Period 1');
      $H_WK1_P1->setWeek($this->getReference('ch-w1'));
      $H_WK1_P1->setStart(new \DateTime('0000-00-00 08:00:00'));
      $H_WK1_P1->setEnd(new \DateTime('0000-00-00 08:45:00'));
      $H_WK1_P1->setSpecial(false);
      $manager->persist($H_WK1_P1);
      $this->addReference('ch-w1-p1', $H_WK1_P1);
      
      // hinds :: week 1 - period 2
      $H_WK1_P2 = new Period();
      $H_WK1_P2->setName('Period 2');
      $H_WK1_P2->setWeek($this->getReference('ch-w1'));
      $H_WK1_P2->setStart(new \DateTime('0000-00-00 09:00:00'));
      $H_WK1_P2->setEnd(new \DateTime('0000-00-00 09:45:00'));
      $H_WK1_P2->setSpecial(false);
      $manager->persist($H_WK1_P2);
      $this->addReference('ch-w1-p2', $H_WK1_P2);
      
      // hinds :: week 1 - period 3
      $H_WK1_P3 = new Period();
      $H_WK1_P3->setName('Period 3');
      $H_WK1_P3->setWeek($this->getReference('ch-w1'));
      $H_WK1_P3->setStart(new \DateTime('0000-00-00 10:00:00'));
      $H_WK1_P3->setEnd(new \DateTime('0000-00-00 10:45:00'));
      $H_WK1_P3->setSpecial(false);
      $manager->persist($H_WK1_P3);
      $this->addReference('ch-w1-p3', $H_WK1_P3);  
      
      // hinds :: week 1 - period 4
      $H_WK1_P4 = new Period();
      $H_WK1_P4->setName('Period 4');
      $H_WK1_P4->setWeek($this->getReference('ch-w1'));
      $H_WK1_P4->setStart(new \DateTime('0000-00-00 13:00:00'));
      $H_WK1_P4->setEnd(new \DateTime('0000-00-00 13:45:00'));
      $H_WK1_P4->setSpecial(true);
      $manager->persist($H_WK1_P4);
      $this->addReference('ch-w1-p4', $H_WK1_P4);
      
      // hinds :: week 1 - period 5
      $H_WK1_P5 = new Period();
      $H_WK1_P5->setName('Period 5');
      $H_WK1_P5->setWeek($this->getReference('ch-w1'));
      $H_WK1_P5->setStart(new \DateTime('0000-00-00 14:00:00'));
      $H_WK1_P5->setEnd(new \DateTime('0000-00-00 14:45:00'));
      $H_WK1_P5->setSpecial(true);
      $manager->persist($H_WK1_P5);
      $this->addReference('ch-w1-p5', $H_WK1_P5);
      
      // hinds :: week 1 - period 6
      $H_WK1_P6 = new Period();
      $H_WK1_P6->setName('Period 6');
      $H_WK1_P6->setWeek($this->getReference('ch-w1'));
      $H_WK1_P6->setStart(new \DateTime('0000-00-00 15:00:00'));
      $H_WK1_P6->setEnd(new \DateTime('0000-00-00 15:45:00'));
      $H_WK1_P6->setSpecial(true);
      $manager->persist($H_WK1_P6);
      $this->addReference('ch-w1-p6', $H_WK1_P6);
      
      // hinds :: week 1 - mon eve
      $H_WK1_ME = new Period();
      $H_WK1_ME->setName('Monday Evening');
      $H_WK1_ME->setWeek($this->getReference('ch-w1'));
      $H_WK1_ME->setStart(new \DateTime('0000-00-00 20:00:00'));
      $H_WK1_ME->setEnd(new \DateTime('0000-00-00 20:45:00'));
      $H_WK1_ME->setSpecial(true);
      $manager->persist($H_WK1_ME);
      $this->addReference('ch-w1-me', $H_WK1_ME);
      
      $manager->flush();
    }
    
    public function getOrder() { return 12; }
  }
