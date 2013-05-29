<?php

namespace Scss\CourseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Scss\CourseBundle\Repository\RequirementRepository")
 * @ORM\Table(name="requirement")
 */
class Requirement 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Slug(fields={"name"}) 
     * @ORM\Column(length=128, unique=true)
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

    /**
     * @ORM\Column(type="string", length=150)
     * @var type 
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Requirement", inversedBy="requirement")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */        
    protected $parent;

    /**
     * @ORM\Column(type="text")
     * @var type 
     */
    protected $text;

    /**
     * @ORM(\ManyToOne(targetEntity="MeritBadge", inversedBy="requirement")
     * @ORM\JoinColumn(name="merit_badge_id", referencedColumnName="id")
     */
    protected $merit_badge;

    public function getMeritBadge() 
    {
      return $this->merit_badge;
    }

    public function setMeritBadge( Scss\CourseBundle\Entity\MeritBadge $mb )
    {
      $this->merit_badge = $mb;

      return $this;
    }

    protected $attributes = array();

    protected $children = array();
  
    /**
     * Checks if given name is already in use within the landmark tree
     * Throws exception is is used.
     * 
     * @param string $name
     * @return string|\Landmarx\Landmark\LandmarkItem
     * @throws InvalidArgumentException
     */
    public function setName($name) {
      if($this->name == $name)  
        return $this;
      
      $parent = $this->getParent();
      if(is_null($parent) && isset($parent['name']))
        throw new InvalidArgument('Requirement name is already used.');
      
      $_name = $this->name;
      $this->name = $name;
      
      if(!is_null($parent)) {
        $names = array_keys($parent->getChildren());
        $items = array_values($parent->getChildren());
        
        $offset = array_search($_name, $names);
        $names[$offset] = $name;
        
        $parent->setChildren(array_combine($names, $items));
      }
      return $this;
    } 

    /**
     * Add a new child to this landmark item
     * Takes in an instance of a landmarkItem or as string name
     * 
     * @param string|Landmarx\Landmark\LandmarkItemInterface $child
     * @param array $options
     * @return Landmarx\Landmark\LandmarkItem
     * @throws InvalidArgumentException
     */
    public function addChild($child, array $options = array()) {
      if(!$child instanceof Requirement)  $child = new Requirement($child, $options);
      elseif(null !== $child->getParent())
        throw new InvalidArgument('Cannot add item as child, it already belongs to another requirement.');
        
      $child->setParent($this);
      $this->children[$child->getName()] = $child;

      return $child;
    }

    public function getChild($name) {
      return isset($this->children[$name]) ? $this->children[$name] : null;
    }

    public function moveToPosition($position) {
      $this->getParent()->moveChildToPosition($this, $position);

      return $this;
    }

    public function moveChildToPosition(ItemInterface $child, $position) {
      $name = $child->getName();
      $order = array_keys($this->children);

      $_position = array_search($name, $order);
      unset($order[$_position]);

      $order = array_values($order);

      array_splice($order, $position, 0, $name);
      $this->reorderChildren($order);

      return $this;
    }

    public function moveToFirstPosition() {
      return $this->moveToPosition(0);
    }

    public function moveToLastPosition() {
      return $this->moveToPosition($this->getParent()->count());
    }

    public function reorderChildren($order) {
      if(count($order) != $this->count())
        throw new InvalidArgument('Cannot reorder children, order does not contain all children.');
        
      $kids = array();

      foreach($order as $name) {
        if(!isset($this->children[$name]))
            throw new InvalidArgument('Cannot find children named ' . $name);

        $child = $this->children[$name];
        $kids[$name] = $child;
      }

      $this->children = $kids;

      return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function getAttribute($name, $default = null)
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        return $default;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }
    
    public function copy() {
      $_landmark = clone $this;
      $_landmark->children = array();
      $_landmark->setParent(null);
      foreach($this->getChildren() as $child)
        $_landmark->addChild($child->copy());
      
      return $_landmark;
    }

    public function slice($offset, $length = null) {
      $names = array_keys($this->getChildren());
      if($offset instanceof Requirement)
        $offset = $offset->getName();
      
      if(!is_numeric($offset)) 
        $offset = array_search($offset, $names);
       
      if(null !== $length) {
        if($length instanceof Requirement)
          $length = $length->getName();
          
        if(!is_numeric($length)) {
          $index = array_search($length, $names);
          $length = ($index < $offset) ? 0 : $index - $offset;
        }
      }
      $item = $this->copy();
      $children =  array_slice($item->getChildren(), $offset, $length);
      $item->setChildren($children);

      return $item;
    }

    public function split($length) {
      $ret = array();
      $ret['primary'] = $this->slice(0, $length);
      $ret['secondary'] = $this->slice($length);

      return $ret;
    }

    public function getLevel() {
      return $this->parent ? $this->parent->getLevel() + 1 : 0;
    }

    public function getRoot() {
      $obj = $this;
      do {
        $found = $obj;
      } while ($obj = $obj->getParent());

      return $found;
    }

    public function isRoot() {
      return null === $this->parent;
    }

    public function getChildren() {
      return $this->children;
    }

    public function setChildren(array $children) {
      $this->children = $children;

      return $this;
    }

    public function removeChild($name) {
      $name = $name instanceof ItemInterface ? $name->getName() : $name;

      if(isset($this->children[$name])) {
        $this->children[$name]->setParent(null);
        unset($this->children[$name]);
      }

      return $this;
    }

    public function getFirstChild() {
      return reset($this->children);
    }

    public function getLastChild() {
      return end($this->children);
    }

    public function hasChildren() {
      return $this->children;
    }
    
    public function isLast() {
      if ($this->isRoot())  return false;

      return $this->getParent()->getLastChild() === $this;
    }

    public function isFirst() {
      if ($this->isRoot()) return false;

      return $this->getParent()->getFirstChild() === $this;
    }
    
    public function callRecursively($method, $arguments = array()) {
      call_user_func_array(array($this, $method), $arguments);

      foreach($this->children as $child)
        $child->callRecursively($method, $arguments);

      return $this;
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
     * Set slug
     *
     * @param string $slug
     * @return Requirement
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param datetime $created
     * @return Requirement
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     * @return Requirement
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
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
     * Set optional
     *
     * @param boolean $optional
     * @return Requirement
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;
        return $this;
    }

    /**
     * Get optional
     *
     * @return boolean 
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * Set text
     *
     * @param text $text
     * @return Requirement
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set parent
     *
     * @param Scss\CourseBundle\Entity\Requirement $parent
     * @return Requirement
     */
    public function setParent(Requirement $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Scss\CourseBundle\Entity\Requirement 
     */
    public function getParent()
    {
        return $this->parent;
    }
}