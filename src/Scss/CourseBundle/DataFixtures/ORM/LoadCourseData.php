<?php
  namespace Scss\CourseBundle\DataFixtures\ORM;
  
  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use Scss\CourseBundle\Entity\Course;
  use Scss\FacilityBundle\Entity\Facility;
  
  class LoadCourseData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      $userAdmin = new Course();
      $userAdmin->setUsername('American Cultures');
      $userAdmin->setFacility();
      
      $manager->persist($userAdmin);
      $manager->flush();
      
      $this->addReference('admin-user', $userAdmin);
    }
    
    public function getOrder() { return 1; }
  }
