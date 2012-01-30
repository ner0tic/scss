<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssPatrolQuery extends Doctrine_Query {
  /**
   *
   * @param type $id
   * @return type 
   */
  public function selectForDashboard($id) {
    $a = $this->getRootAlias();
    return $this->select($a.'.name, '.$a.'.img')->andWhere($a.'.troop_id = ?', $id)->orderBy($a.'.name ASC');
  }
}