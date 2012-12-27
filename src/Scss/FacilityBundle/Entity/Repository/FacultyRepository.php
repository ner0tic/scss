<?php
  namespace Scss\FacilityBundle\Repository;

  use Doctrine\ORM\EntityRepository;

  class FacultyRepository extends EntityRepository {
    public function filterByFacility($facility) {
      if(!$facility instanceof Scss\FacillityBundle\Entity\Faculty) // object
        throw new \InvalidArgumentException('argument must be of type Faculty');
      $query = 'SELECT f FROM ScssFacilityBundle:Faculty f where f.facility_id = :id';      
      
      return $this->getEntityManager()->createQuery($query)->setParameter('id', $facility->getId())->getResult();
    }
  }