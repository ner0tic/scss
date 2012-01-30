<?php

/**
 * @package ddLightboxPlugin
 * 
 * @author David Durost
 * 
 */

/**
 *
 * @param string $name
 * @param string $url
 * @param array $opts
 * @return string 
 */
function lb_link_to($name,$url,$lnk_opts = array(), $lb_opts = array()) {
  $opts = array_merge($opts,array('class' => 'lightbox'));
  if(!isset($lb_opts['width'])) $lb_opts['width'] = sfConfig::get('app_ddlightbox_width');
  if(!isset($lb_opts['height'])) $lb_opts['height'] = sfConfig::get('app_ddlightbox_height');
  $url .= '?lightbox[width]='.$lb_opts['width'].'&lightbox[height]='.$lb_opts['height'].(isset($lb_opts['modal']) ? '&lightbox[modal]='.$lb_opts['modal'] : '');
  
  $response = sfContext::getInstance()->getResponse();
  $response->addJavascript(sfConfig::get("app_ddlightbox_js_dir").'jquery.lightbox.min.js');
  $response->addStylesheet(sfConfig::get("app_ddlightbox_css_dir").'jquery.lightbox.css');  
  
  echo javascript_tag("$('.lightbox').lightbox();");
  return link_to($name,$url, $opts);
}