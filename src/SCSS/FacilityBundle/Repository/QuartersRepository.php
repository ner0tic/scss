<?php
namespace SCSS\FacilityBundle\Repository;

use Doctrine\ORM\EntityRepository;

class QuartersRepository extends EntityRepository
{
    public function filterByType($type = 'passel')
    {
        return null;
    }
}
