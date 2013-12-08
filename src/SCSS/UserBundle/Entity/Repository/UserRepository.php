<?php
namespace SCSS\UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\USerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserRepository extends EntityRepository implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $q = $this->createQueryBuilder( 'u' )
                  ->select( 'u, g' )
                  ->leftJoin( 'u.groups', 'g' )
                  ->where( 'u.username = :username OR u.email = :email' )
                  ->setParameter( 'username', $username )
                  ->setParameter( 'email', $username )
                  ->getQuery();

        return $q->getResult();
    }

    public function refreshUser( UserInterface $user )
    {
        $class = get_class( $user );

        if( !$this->supportsClass( $class ) )
        {
            throw new UnsupportedUserException('user is an incorrect type.');
        }

        return $this->find( $user->getId() );
    }

    public function supportsClass( $class )
    {
        return $this->getEntityName() === $class || is_sub_class_of( $class, $this->getEntityName() );
    }
}
