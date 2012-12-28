<?php
namespace Scss\OrganizationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Scss\OrganizationBundle\Entity\Passel;
use Scss\OrganizationBundle\Entity\Faction;

class AttendeeRepository extends EntityRepository
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
            ->createQuery( 'SELECT a FROM ScssOrganizationBundle:Attendee a WHERE a.passel = :passel ORDER BY a.last_name ASC' )
            ->setParameter( 'passel', $passel )
            ->getResult();
    }
    
    public function filterByFaction($faction)
    {
        if( $faction instanceof Faction )
        {
            $faction = $faction->getId();
        }
        elseif( ( $faction === null ) || !is_numeric($faction) )
        {
            $faction = 0;
        }
        
        return $this->getEntityManager()
            ->createQuery( 'SELECT a FROM ScssOrganizationBundle:Attendee a WHERE a.faction = :faction ORDER BY a.last_name ASC' )
            ->setParameter( 'faction', $faction )
            ->getResult();
    }
    
}
