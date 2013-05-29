<?php
	namespace Scss\OrganizationBundle\Entity;

	use Doctrine\ORM\Mapping as ORM,
			Gedmo\Mapping\Annotation as Gedmo,
			Symfony\Component\Validator\Constraints as Assert;

	/**
	 * @ORM\Entity(repositoryClass="Scss\OrganizationBundle\Repository\CouncilRepository")
	 * @ORM\Table(name="council")
	 */
	class Council
	{
		/**
		 * @ORM\Id
		 * @ORM\Column(type="integer")
		 * @ORM\GeneratedValue(strategy="AUTO")
		 */
		protected $id;

		/**
		 * @ORM\Column(type="string")
		 * @Assert\MaxLength(250)
		 * 
		 * @var string
		 */
		protected $name;

		/**
         * @ORM\ManyToOne(targetEntity="Scss\OrganizationBundle\Entity\Organization", inversedBy="council")
         * @ORM\JoinColumn(name="organization_id", referencedColumnName="id")
         */    
        protected $organization;

        /**
         * @ORM\ManyToOne(targetEntity="Scss\UserBundle\Entity\AddressBook", inversedBy="council")
         * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
         */    
        protected $address = null;

		/**
		 * @Gedmo\Slug(fields={"name"})
		 * @ORM\Column(unique=true)
		 * @Assert\MaxLength(128)
		 */
		protected $slug;

		/**
         * @var datetime $created
         *
         * @Gedmo\Timestampable(on="create")
         * @ORM\Column(type="datetime")
         */
        private $created;

        /**
         * @var datetime $updated
         *
         * @Gedmo\Timestampable(on="update")
         * @ORM\Column(type="datetime")
         */
        private $updated;

	}