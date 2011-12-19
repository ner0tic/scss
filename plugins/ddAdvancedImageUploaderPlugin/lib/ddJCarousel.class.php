<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ddJCarousel
 *
 * @author ner0tic
 */
class ddJCarousel {
  protected 
    $_name          = null,
    $_displayName   = null,
    $_jsOpts          = array();
  protected
    $_context       = null,
    $_renderer      = 'ddAdvancedImageUploaderGalleryRenderer';
  protected 
    $_pathTo        = null,
    $_jsPath        = null,
    $_cssPath       = null;
   
  public function __constructor($n,$o=array()) {
    $this->_name = $n;
    /**
     * default options
     */
    $this->_jsOpts = array_merge(array(
        //'id' => '#carousel',
        'auto' => 2,
        'skin' => 'tango',
        'start' => '3',
        'scroll' => '1',
        'initCallback' => 'off',
        'nb_item' => '3',
        'direction' => 'horizontal',     // horizontal or vertical
        'autoscroll' => 'on',
        'easing' => 'off',
        'buttonNextHTML' => 'off',
        'buttonPrevHTML' => 'off',
        'warp' => 'off'),$o['js']);
     $this->_context  = new stdClass();
     $this->_context->user = null;
     $this->_context->session = array(ini_get('session.name') =>  session_id());
     $this->_pathTo   = (isset($o['filePath']) ? $o['filePath'] : sfConfig::get('app_ddjcarousel_dir').'/');
     $this->_jsPath   = $this->_pathTo.'js/';
     $this->_cssPath  = $this->_pathTo.'css/';      
  }
  
   public function setContext(stdClass $c) { 
     $this->_context = $c;
     return $this;
   }
   public function getContext() {
     return $this->_context;
   }
   
   public function setUser(sfUser $u) {
     $this->_context->user = $u;
     return $u;     
   }
   public function getUser() {
     return $this->_context->user;
   }
   
   public function setRenderer($r) {
     if(!class_exists($r))  throw new sfException('Renderer not found. Could not locate renderer '.$r.'.');
     $this->_renderer = $r;
     return $this;
   }
   public function render() {
     $r = new $this->_renderer();
     $r->render($this);
   }
   
   public function setPath($path, $cat=null) {
     if($cat == 'js')
       $this->_jsPath = $path;
     else if($cat == 'css')
      $this->_cssPath = $path;
     else if(is_null($cat)) $this->_pathTo = $path;
     return $this;
   }
   public function getPath($fullPath=false, $cat=null) {
     if($cat == 'js') return $this->_jsPath;
     else if($cat == 'css') return $this->_cssPath;
     else return $this->_pathTo;
   }
   
   public function setJsOptions(array $o,$overwrite=false) {
     $this->_jsOpts = ($overwrite ? $o : array_merge($this->_jsOpts,$o));
     return $this;
   }
   public function getJsOptions() { return $this->_jsOpts; }

}

?>
