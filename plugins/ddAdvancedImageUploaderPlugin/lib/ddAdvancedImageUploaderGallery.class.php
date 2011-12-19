<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ddAdvancedImageUploaderGallery
 *
 * @author ner0tic
 */
class ddAdvancedImageUploaderGallery {
    protected 
    $_name          = null,
    $_pathTo        = null;
  protected
    $_jsPath        = null,
    $_jsOptions     = array(),
    $_cssPath       = null,
    $_cssOptions    = array();
  protected
    $_context       = false,
    $_request       = false,
    $_renderer      = 'ddAdvancedImageUploaderEngineRenderer';
  
  public function __constructor($n,$o=array()) {
    $this->_name            = $n;
    $this->_pathTo          = isset($o['pathTo']) ? $o['pathTo'] : sfConfig::get('sf_web_dir').'/ddAdvancedImageUploader/engines/'.sfConfig::get('app_ddAdvancedImageUploader_engine_name').'/';
    $this->_jsPath          = $this->_pathTo.'js/';
    $this->_jsOptions       = isset($o['js']) ? $o['js'] : array();
    $this->_cssPath         = $this->_pathTo.'css/';
    $this->_cssOptions      = isset($o['css']) ? $o['css'] : array();
    $this->_context()       = new stdClass();    
  }
  
  public function render() {
    $renderer = new $this->_renderer();
    return $renderer->render($this);
  }  
  public function setRenderer($r) {
    if(!class_exists($r)) throw new sfException('Renderer not found. Could not locate renderer '.$r.'.');
    $this->_renderer = $r;
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
  
  public function setContext(StdClass $c) { $this->_context = $c;  return $this; }
    
  public function getUser() { return $this->_context->user; }
  public function setUser(sfUser $u) { $this->_context->user = $u; return $this; }
}
