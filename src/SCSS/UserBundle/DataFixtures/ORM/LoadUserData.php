<?php
  namespace SCSS\UserBundle\DataFixtures\ORM;

  use Doctrine\Common\Persistence\ObjectManager;
  use Doctrine\Common\DataFixtures\AbstractFixture;
  use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
  use SCSS\UserBundle\Entity\User;

  class LoadUserData extends AbstractFixture implements OrderedFixtureInterface {
    public function load(ObjectManager $manager) {
      $userAdmin = new User();
      $userAdmin->setUsername('ner0tic');
      $userAdmin->setPassword('gatorade');
      $userAdmin->setEmail('david.durost@gmail.com');
      $userAdmin->setFirstName('David');
      $userAdmin->setLastName('Durost');
      $manager->persist($userAdmin);
      $this->addReference('admin-user', $userAdmin);

      $manager->flush();
    }

    public function getOrder() { return 1; }
  }
