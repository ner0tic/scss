<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssCourseQuery extends Doctrine_Query {
 
  /**
   *
   * @param $camp
   * @return Doctrine_Query
   */
  public function filterByCamp($camp) {
    if(is_object($camp))  $id = $camp->getId();
    elseif(is_null($camp))  return null;
    else $id = $camp;
    return $this->andWhere($this->getRootAlias().'.camp_id = ?', $id);   
  }
   
  /**
   *
   * @param $mb
   * @return Doctrine_Query 
   */
  public function filterByMeritBadge($mb) {
    if(is_object($mb))  $id = $mb->getId();
    elseif(is_null($mb))  return null;
    else $id = $mb;
    return $this->andWhere($this->getRootAlias().'.meritbadge_id = ?', $id);   
  }  
  
  /**
   *
   * @return Doctrine_Query 
   */
  public function selectForForm() {
    return $this->leftJoin($this->getRootAlias().'.MeritBadge mb')->select($this->getRootAlias().'.id, mb.name');
  }
}

?>
