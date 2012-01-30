<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssScoutQuery extends Doctrine_Query {

  public function filterByTroop($troop) {
    if(is_object($troop))  $id = $troop->getId();
    elseif(is_null($troop))  return null;
    else $id = $troop;
    
    return $this->leftJoin($this->getRootAlias().'.Patrol pl')->andWhere('pl.troop_id = ?', $id);   
  }
  
  public function selectForDashboard($id) {
    $a = $this->getRootAlias();
    return $this->select($a.'.first_name, '.$a.'.last_name, '.$a.'.dob, b.name')->leftJoin($a.'.Patrol b')->andWhere('b.troop_id = ?', $id)->orderBy($a.'.last_name, '.$a.'.first_name ASC');
  }
  
}

?>
