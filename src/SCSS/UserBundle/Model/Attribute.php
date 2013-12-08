<?php
namespace SCSS\UserBundle\Model;

class Attribute implements AttributeInterface
{
    /**
     * Name
     * @ORM\Column(name="name", type="text")
     */
    protected $name;

    /**
     * Get
     * 
     * @return  Self
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set
     * 
     * @param $name name
     * @return  Self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Description
     * @ORM\Column(name="description", type="text")
     * @param $description description
     */
    protected $description;

    /**
     * Get
     * 
     * @return description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set
     * 
     * @param $description description
     * @return Self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    protected $options = array();

    protected $required = false;
}