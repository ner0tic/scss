<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/scout/index')->

  with('request')->begin()->
    isParameter('module', 'scout')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;

$browser->info('3 - Post a Scout page')->
  info('  3.1 - Submit a Scout')->
 
  get('/scout/new')->
  with('request')->begin()->
    isParameter('module', 'scout')->
    isParameter('action', 'new')->
  end()
;