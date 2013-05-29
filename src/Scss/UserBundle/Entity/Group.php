<?php
    namespace Scss\UserBundle\Entity;

    use Symfony\Component\Security\Core\Role\RoleInterface,
        Symfony\Component\Validator\Constraints as Assert,
        Doctrine\Common\Collections\ArrayCollection,
        Doctrine\ORM\Mapping as ORM,
        FOS\UserBundle\Entity\Group as BaseGroup;

    /**
     * @ORM\Table(name="fos_groups")
     * @ORM\Entity()
     */
    class Group extends BaseGroup implements RoleInterface
    {
        /**
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id()
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;



        /**
         * @ORM\Column(name="role", type="string")
         * @Assert\MaxLength(20)
         */
        protected $role;

        /**
         * @ORM\ManyToMany(targetEntity="User", mappedBy="groups")
         */
        protected $users;

        public function __construct()
        {
            $this->users = new ArrayCollection();
        }

        /**
         * @see RoleInterface
         */
        public function getRole()
        {
            return $this->role;
        }

        /**
         * Get id
         *
         * @return integer 
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set name
         *
         * @param string $name
         * @return Group
         */
        public function setName($name)
        {
            $this->name = $name;
            return $this;
        }

        /**
         * Get name
         *
         * @return string 
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Set role
         *
         * @param string $role
         * @return Group
         */
        public function setRole($role)
        {
            $this->role = $role;
            return $this;
        }

        /**
         * Add users
         *
         * @param Scss\UserBundle\Entity\User $users
         * @return Group
         */
        public function addUser(\Scss\UserBundle\Entity\User $users)
        {
            $this->users[] = $users;
            return $this;
        }

        /**
         * Remove users
         *
         * @param Scss\UserBundle\Entity\User $users
         */
        public function removeUser(\Scss\UserBundle\Entity\User $users)
        {
            $this->users->removeElement($users);
        }

        /**
         * Get users
         *
         * @return Doctrine\Common\Collections\Collection 
         */
        public function getUsers()
        {
            return $this->users;
        }
    }