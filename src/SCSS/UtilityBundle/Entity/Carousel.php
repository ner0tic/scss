<?php
namespace SCSS\UtilityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use SCSS\UtilityBundle\Entity\CarouselItem;
use SCSS\UtilityBundle\Traits\SluggableTrait;
use SCSS\UtilityBundle\Traits\TimestampableTrait;

class Carousel
{
    use SluggableTrait;
    use TimestampableTrait;
    

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = "1",
     *      max = "250",
     *      minMessage = "Name must be at least {{ limit }} characters length",
     *      maxMessage = "Name cannot be longer than {{ limit }} characters length"
     * )
     * @var string
     */
    protected $name;

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
     * @param string $name name
     *
     * @return Passel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @ORM\OneToMany(targetEntity="CarouselItem", mappedBy="carousel")
     */
    protected $items;

    /**
     * Get items
     *
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set items
     *
     * @param array $items items
     *
     * @return self
     */
    public function setItems(array $items)
    {
        if (! $items instanceof ArrayCollection) {
            $items = new ArrayCollection($items);
        }

        $this->items = $items;

        return $this;
    }

    /**
     * Has items
     *
     * @return boolean
     */
    public function hasItems()
    {
        return !$this->items->isEmpty();
    }

    /**
     * Get a item
     *
     * @param CarouselItem|String $item item
     *
     * @return CarouselItem
     */
    public function getItem($item)
    {
        return $this->items->get($item);
    }

    /**
     * Add a item
     *
     * @param CarouselItem $item item
     *
     * @return self
     */
    public function addItem(CarouselItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove a item
     *
     * @param CarouselItem|String $item item
     *
     * @return self
     */
    public function removeItem(CarouselItem $item)
    {
        unset($this->items[$item]);

        return $this;
    }
}