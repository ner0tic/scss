<?php
  namespace Scss\CourseBundle\Model;

  use Doctrine\Common\Collections\Collection,
      Doctrine\Common\Collections\ArrayCollection;

  abstract class Course 
  {
    /**
     * course title
     * @var string
     */
    protected $name;

    /**
     * array of organizations associated with  the course.
     * @var array
     */
    protected $organizations;
    /**       
     * Set name
     * @param string $name
     * @return Course
     */
    public function setName( $name )
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

    public function addOrganization( $org )
    {
      $this->organizations[] = $org;

      return $this;
    }

    public function removeOrganization( $org )
    {
      if( false !== $key = array_search( strtoupper( $org ), $this->organizations, true ) ) 
      {
        unset( $this->organizations[ $key ] );
        $this->organizations = array_values( $this->organizations );
      }

      return $this;
    }

    public function getOrganiztion( $org )
    {
      return $this->organizations[ $org ];
    }

    public function setOrganizations( array $orgs )
    {
      $this->organizations = array();

      foreach( $orgs as $org )
      {
        $this->addOrganization( $org );
      }

      return $this;
    }

    public function getOrganizations()
    {
      return $this->organizations;
    }
  }     
