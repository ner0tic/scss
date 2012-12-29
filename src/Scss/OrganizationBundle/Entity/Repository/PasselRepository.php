<?php
namespace Scss\OrganizationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Scss\OrganizationBundle\Entity\Passel;
use Scss\OrganizationBundle\Entity\Faction;

class PasselRepository extends EntityRepository
{
    public function filterByZone( $zone )
    {
        if( $zone === null ) 
        {
            throw new \InvalidArgumentException('the zone can not be null.');
        }
        
        return $this->getEntityManager()
            ->createQuery( 'SELECT o FROM ScssOrganizationBundle:Passel o WHERE o.zone = :zone ORDER BY o.name ASC' )
            ->setParameter( 'zone', $zone )
            ->getResult();
    }
    
    public function filterByCountry( $country )
    {
        if( $country === null ) 
        {
            throw new \InvalidArgumentException('the country can not be null.');
        }
        
        return $this->getEntityManager()
            ->createQuery( 'SELECT o FROM ScssOrganizationBundle:Passel o WHERE o.country = :country ORDER BY o.name ASC' )
            ->setParameter( 'country', $country )
            ->getResult();
    }      
}
