<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ddUploadify
 *
 * @author ner0tic
 */
class ddUploadify {
  protected
    $_name          = null,
    $_jsOpts        = array(),
    $_cssOpts       = array(),
    $_uploader      = null;
  protected
    $_context       = null,
    $_renderer      = 'ddAdvancedImageUploaderEngineRenderer';
   protected 
    $_pathTo        = null,
    $_jsPath        = null,
    $_cssPath       = null;
      
   public function __constructor($n,$o=array()) {
     $this->_name     = $n;
     $this->_uploader = isset($o['uploader']) ? $o['uploader'] : 'uploadify.swf';
     $this->_jsOpts   = isset($o['jsOpts']) ? $o['jsOpts'] : array();
     $this->_cssOpts  = isset($o['cssOpts']) ? $o['cssOpts'] : array();
     $this->_context  = new stdClass();
     $this->_context->user = null;
     $this->_context->session = array(ini_get('session.name') =>  session_id());
     $this->_pathTo   = isset($o['filePath']) ? $o['filePath'] : sfConfig::get('app_dduploadify_dir').'/';
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
   
   public function setUploader($u='uploadify.swf') {
     $this->_uploader = $u;
     return $this;
   }
   public function getUploader() {
     return $this->_uploader;
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
   
   public function setCssOptions(array $o,$overwrite=false) {
     $this->_cssOpts = ($overwrite ? $o : array_merge($this->_cssOpts,$o));
     return $this;
   }
   public function getCssOptions() { return $this->_cssOpts; }
   
   public function getSession() { return $this->_context->session; }

}

?>
