<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ddAdvancedImageUploader
 *
 * @author ner0tic
 */
class ddAdvancedImageUploader implements ArrayAccess, Countable, Iterator {
  protected 
    $_name          = null,
    $_displayName   = null;
  protected
    $_engine        = null,
    $_gallery       = array();
  protected
    $_context       = false,
    $_request       = false,
    $_renderer      = 'ddAdvancedImageUploaderRenderer';

  public function __construct($n,$e='ddUploadify',$g=ddJCarousel) {
    $this->_name          = $n;
    $this->_engine        = new $e();
    $this->_gallery       = new $g();
    $this->_context       = new stdClass();
    $this->_context->user = null;
  }
  
  public function render() {
    $renderer = new $this->_renderer();
    return $renderer->render($this);
  }
  
  public function setEngine($e,$o=array()) {
    $this->_engine = new $e($this->getName(),$o);
    return $this;
  }
  public function getEngine() {
    return $this->_engine;
  }
  
  public function setGallery($e,$o=array()) {
    $this->_gallery = new $g(null,$o);
    return $this;
  }
  public function getGallery() {
    return $this->_gallery;
  }
  
  public function setRequest(sfWebRequest $r) { $this->_request = $r; return $this; }

  public function setContext(StdClass $c) { $this->_context = $c;  return $this; }
    
  public function getUser() { return $this->_context->user; }
  public function setUser(sfUser $u) { $this->_context->user = $u; return $this; }
  
  public function setName($n) {
    $this->_name = $n;
    return $this;
  }
  public function getName() { return $this->_name; }
  public function getSlug() { return str_replace(' ','-',  strtolower($this->_name)); }
  
  public function setDisplayName($n) {
    $this->_displayName = $n;
    return $this;
  }
  public function getDisplayName() { return $this->_displayName; }
  
}

?>
