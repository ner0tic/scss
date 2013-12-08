<?php
namespace SCSS\UserBundle\Traits;

trait AddressTrait
{
    /**
    * @ORM\Column(type="string", length=150)
    */
    protected $name = '';

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
    * Set name
    *
    * @param string $name
    *
    * @return AddressBook
    */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    * @ORM\Column(type="string", length=150)
    */
    protected $street = '';

    /**
    * Get street
    *
    * @return string
    */
    public function getStreet()
    {
        return $this->street;
    }

    /**
    * Set street
    *
    * @param string $street
    *
    * @return AddressBook
    */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
    * @ORM\Column(type="string", length=150, nullable=true)
    */
    protected $suburb = '';

    /**
    * Get suburb
    *
    * @return string
    */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
    * Set suburb
    *
    * @param string $suburb
    *
    * @return AddressBook
    */
    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    /**
    * @ORM\Column(type="string", length=150)
    */
    protected $city = '';

    /**
    * Get city
    *
    * @return string
    */
    public function getCity()
    {
        return $this->city;
    }

    /**
    * Set city
    *
    * @param string $city
    *
    * @return AddressBook
    */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
    * @ORM\Column(type="string", length=150)
    */
    protected $zone = '';

    /**
    * Get zone
    *
    * @return string
    */
    public function getZone()
    {
        return $this->zone;
    }

    /**
    * Set zone
    *
    * @param string $zone
    *
    * @return AddressBook
    */
    public function setZone($zone)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
    * @ORM\Column(type="string", length=250)
    */
    protected $country = 'United States';

    /**
    * Get country
    *
    * @return string
    */
    public function getCountry()
    {
        return $this->country;
    }

    /**
    * Set country
    *
    * @param string $country
    *
    * @return AddressBook
    */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
    * @ORM\Column(type="string", length=10, nullable=true)
    */
    protected $postalCode = '';

    /**
    * Get postal code
    *
    * @return string
    */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
    * Set postal code
    *
    * @param string $postalCode
    *
    * @return AddressBook
    */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }
}
