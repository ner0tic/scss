<?php
namespace SCSS\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\GeolocatableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

/**
* @ORM\Entity
* @ORM\Table(name="address_book")
*/
class Address
{
    use GeolocatableTrait;
    use TimestampableTrait;
    use SluggableTrait;

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

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
    * @return Address
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
    * @return Address
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
    * @return Address
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
    * @return Address
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
    * @return Address
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
    * @return Address
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
    * @return Address
    */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Formats an address in an array form
     *
     * @param array  $address The address array (required keys: firstname, lastname, address1, postcode, city, country_code)
     * @param string $sep     The address separator
     *
     * @return string
     */
    public static function formatAddress(array $address, $sep = ", ")
    {
        $values = array_map(
            'trim',
            array(
                sprintf("%s %s", $address['first_name'], $address['last_name']),
                $address['address'],
                $address['postal_code'],
                $address['city']
            )
        );

        foreach ($values as $key => $val) {
            if (!$val) {
                unset($values[$key]);
            }
        }

        $fullAddress = implode($sep, $values);

        if ($countryCode = trim($address['country_code'])) {
            if ($fullAddress) {
                $fullAddress .= " ";
            }

            $fullAddress .= sprintf("(%s)", $countryCode);
        }

        return $fullAddress;
    }
}
