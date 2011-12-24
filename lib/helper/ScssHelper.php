<?php

function scss_link_to($name,$url,$opts = array()) {
  // get user
  $sf_user = sfContext::getInstance()->getUser();
  // get route data for given route
  $sf_route = sfContext::getInstance()->getRouting()->getRoutes();
  $sf_route = $sf_route[$url];
  // use active enrollment troop or assigned troop
  $use_active = isset($opts['use_active']) ? $opts['use_active'] : false;
  unset($opts['use_active']);
  // get slug array
  $_p = array();
  foreach($sf_route->getDefaultParameters() as $r)
    $_p[$r] = Scss::genSlugArray(array(($use_active ? 'a_' : '').$r));
  return link_to($name,$url,array_merge($opts,$_p));
}

?>
