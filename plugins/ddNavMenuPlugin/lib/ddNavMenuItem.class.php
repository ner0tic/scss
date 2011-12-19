<?php // lib/ddNavMenuItem.class.php
  class ddNavMenuItem implements ArrayAccess, Countable, IteratorAggregate {
    protected
      $_name          = null,
      $_label         = null,
      $_route         = null,
      $_parameters    = array(),
      $_credentials   = array(),
      $_requiresAuth   = null,
      $_requiresNoAuth = null;
    protected
      $_children      = array(),
      $_position      = null,
      $_parent        = null;
    protected
      $_context       = false,
      $_request       = false,
      $_renderer       = 'ddNavMenuRenderer';

    public function __construct($n,$r=null,$p=array()) {
      $this->_name        = $n;
      $this->_route       = $r;
      $this->_parameters  = $p;
      $this->_context     = new StdClass();
      $this->_context->user = null;
    }

    public function render() {
        $renderer = new $this->_renderer();
        return $renderer->render($this);
    }

    public function isAuthorized(sfBasicSecurity $u = null) {
      $auth = true;
      if(is_null($u)) $u = $this->setUser(sfContext::getInstance()->getUser())->getUser();
      
      if($u->isAuthenticated() && $this->requiresNoAuth())  $auth = false;
      elseif(!$u->isAuthenticated() && $this->requiresAuth()) $auth = false;
      else  $auth = $u->checkCredentials($this->getCredentials(),false);
      return $auth;
    }


    public function getName() { return $this->_name; }
    public function setName($n) {
      if($this->getParent() && $this->getParent()->getChild($n,false))
        throw new sfException('Rename failed.  '.$n.' already exists.');
      $o = $this->_name;
      $this->_name = $n;
      if($this->getParent())
        $this->getParent()->updateChildId($this,$o);
    }
    protected function updateChildId(ddMenuItem $i, $o) {
      $names = array_keys($this->getChildren());
      $items = array_values($this->getChildren());
      $offset = array_search($o,$names);
      $children = array_combine($names,$items);
      $this->setChildren($children);
    }

    public function getRoute() { return $this->_route; }
    public function setRoute($r) { $this->_route = $r; }

    public function getLabel() { return (is_null($this->_label)?$this->getName():$this->_label); }
    public function setLabel($l) { $this->_label = $l; }

    public function getParameter($n) {
      if(!isset($this->_parameters[$n]))
        throw new sfException('Parameter not found.  Could not locate '.$n.'.');
      return $this->_parameter[$n];
    }
    public function setParameter($n,$v) { $this->_parameters[$n] = $v; }

    public function getParameters() { return $this->_parameters; }
    public function setParameters($p) {
      if(!is_array($p)) throw new sfException('The parameters must be encased in an array.');
      $this->_parameters = $p;
      return $this;
    }

    public function getCredentials() { return $this->_credentials; }
    public function setCredentials(array $c) { $this->_credentials = $c; return $this; }

    public function requiresAuth($bool = null) {
      if(!is_null($bool)) $this->_requiresAuth = $bool;
      return $this->_requiresAuth;
    }
    public function requiresNoAuth($bool = null) {
      if(!is_null($bool)) $this->_requiresNoAuth = $bool;
      return $this->_requiresNoAuth;
    }

    public function hasChildren() { return (count($this->_children)>0); }
    public function getChildren() { return $this->_children; }
    public function setChildren(array $c) { $this->_children = $c; }

    public function getParent() { return $this->_parent; }
    public function setParent(ddNavMenuItem $i) { $this->_parent = $i; }

    public function addChild($c,$r = null, $p = array(), $class = null) {
      if(!$c instanceof ddNavMenuItem) {
        if (is_null($class))
          $class = get_class($this);
        $c =  new $class($c,$r,$p);       
      }
      elseif ($c->getParent())
        throw new sfException('Menu item addition failed. Menu item ('.$c.') already exists.');
      $c->setParent($this);
      $c->setPosition($this->count());
      $this->_children[$c->getName()] = $c;
      return $c;
    }
    public function removeChild(ddNavMenuItem $c) { unset($this->_children[$c->getName()]); }
    public function getChild($n,$create = true) {
      if(!isset($this->_children[$n]) && $create) $this->addChild($n);
      return isset($this->_children[$n]) ? $this->_children[$n] : null;
    }

    public function getPosition() { return $this->_position; }
    public function setPosition($p) { $this->_position = $p; }
    public function resetChildPositions() {
      $i = 0;
      foreach($this->_children as $child) $child->setPosition($i++);
    }

    public function setRequest(sfWebRequest $r) { $this->_request = $r; return $this; }

    public function setContext(StdClass $c) { $this->_context = $c;  return $this; }
    
    public function getUser() { return $this->_context->user; }
    public function setUser(sfUser $u) { $this->_context->user = $u; return $this; }

    public function toArray($incChildren = true) {
      $fields = array(
                '_name'           => 'name',
                '_label'          => 'label',
                '_route'          => 'route',
                '_requiresAuth'   => 'requires_auth',
                '_requiresNoAuth' => 'requires_no_auth',
                '_credentials'    => 'credentials',
                '_parameters'     => 'parameters',
      );
      $array = array();
      foreach ($fields as $propName => $field)
        $array[$field] = $this->$propName;
      $array['class'] = get_class($this);
      if($incChildren) {
        $array['children'] = array();
        foreach ($this->_children as $key => $child) {
          $array['children'][$key] = $child->toArray();
        }
      }
      return $array;
    }
    public function fromArray($array) {
      if (isset($array['name']))  $this->setName($array['name']);
      if (isset($array['label'])) $this->setLabel($array['label']);
      if (isset($array['route'])) $this->setRoute($array['route']);
      if (isset($array['requires_auth'])) $this->requiresAuth($array['requires_auth']);
      if (isset($array['requires_no_auth'])) $this->requiresNoAuth($array['requires_no_auth']);
      if (isset($array['credentials'])) $this->setCredentials(array($array['credentials']));
      if (isset($array['parameters'])) $this->setParameters(array($array['parameters']));
      if (isset($array['children']) && is_array($array['children'])) {
        foreach ($array['children'] as $name => $child) {
          $child['class'] = isset($child['class']) ? $child['class'] : get_class($this);
          $this->addChild($name)->fromArray($child);
        }
      }
      return $this;
    }
    public static function createFromArray(array $data) {
      $class = isset($data['class']) ? $data['class'] : 'ddNavMenuItem';
      $name = isset($data['name']) ? $data['name'] : null;
      $menu = new $class($name);
      $menu->fromArray($data);
      return $menu;
    }
    public function count() { return count($this->_children); }
    public function getIterator() { return new ArrayObject($this->_children); }
    public function offsetExists($n) { return isset($this->_children[$n]); }
    public function offsetGet($n) { return $this->getChild($n, false); }
    public function offsetSet($n,$v) { return $this->addChild($n)->setLabel($v); }
    public function offsetUnset($n) { $this->removeChild($n); }
  }

