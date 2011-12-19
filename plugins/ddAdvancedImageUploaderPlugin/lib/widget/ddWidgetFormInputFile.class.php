<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ddWidgetFormInputFile
 *
 * @author ner0tic
 */
class ddWidgetFormInputFile  {
  protected $_context;
  protected static $INSTANCE_COUNT = 0;
  
  protected function configure($o = array(), $a = array()) {
    parent::configure($o,$a);
    $this->addOption('path',null);
    $this->addOption('is_hidden',false);
  }
  public function getJavaScripts() {
    $js = array(
        sfConfig::get('dd_AdvImgUploader_web_dir').'/js/uploadify/swfobjects.js',
        sfConfig::get('dd_AdvImgUploader_web_dir').'/js/uploadify/uploadify.js',
        //sfConfig::get('dd_AdvImgUploader_web_dir').'/js/jcarousel/jcarousel.js'        
    );
    return $js;
  }
  
  public function render($n, $v = null, $a = array(), $err = array()) {
    $this->_context = sfContext::getInstance();
    $a = array_merge(array('name' => $n, 'value' => $v), $a);
    
  }
}

?>
