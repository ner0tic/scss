<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssAreaQuery extends Doctrine_Query {

  public function filterByCamp($camp) {
    if(is_object($camp))  $id = $camp->getId();
    elseif(is_null($camp))  return null;
    else $id = $camp;
    
    return $this->andWhere($this->getRootAlias().'.camp_id = ?', $id);   
  }  
}

?>
