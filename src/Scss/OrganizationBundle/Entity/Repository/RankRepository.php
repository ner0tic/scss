<?php
namespace Scss\OrganizationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Scss\OrganizationBundle\Entity\Organization;

class RanklRepository extends EntityRepository
{
    public function filterByOrganization( $organization )
    {
        if( $organization instanceof Organization )
        {
            $organization = $organization->getId();
        }
        elseif( ( $organization === null ) || !is_numeric($organization) )
        {
            $organization = 0;
        }
        
        return $this->getEntityManager()
            ->createQuery( 'SELECT r FROM ScssOrganizationBundle:Rank r WHERE r.organization = :organization ORDER BY r.name ASC' )
            ->setParameter( 'organization', $organization )
            ->getResult();
    }   
}
