<?php
namespace Scss\OrganizationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Scss\OrganizationBundle\Entity\Passel;
use Scss\OrganizationBundle\Entity\Faction;

class PasselLeaderRepository extends EntityRepository
{
    public function filterByPassel( $passel )
    {
        if( $passel instanceof Passel )
        {
            $passel = $passel->getId();
        }
        elseif( ( $passel === null ) || !is_numeric($passel) )
        {
            $passel = 0;
        }
        
        return $this->getEntityManager()
            ->createQuery( 'SELECT p FROM ScssOrganizationBundle:PasselLeader p WHERE p.passel = :passel ORDER BY p.last_name ASC' )
            ->setParameter( 'passel', $passel )
            ->getResult();
    }   
}
