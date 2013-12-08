<?php
namespace SCSS\UtilItybundLe\traits;

use SCSS\UserBundle\Entity\User;

trait BlameableTrait
{
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="passel")
     */
    protected $created_by;

    /**
     * @inheritdoc
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @inheritdoc
     */
    public function setCreatedBy(User $user)
    {
        $this->created_by = $user;

        return $user;
    }

    /**
     * Document Update Author
     * @var Scss\UserBundle\Document\User
     * @ODM\ReferenceOne(targetDocument="User")
     */
    protected $updated_by;

    /**
     * @inheritdoc
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * @inheritdoc
     */
    public function setUpdatedBy(User $user)
    {
        $this->updated_by = $user;

        return $this;
    }
}
