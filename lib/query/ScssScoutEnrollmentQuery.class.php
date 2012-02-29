<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssScoutEnrollmentQuery extends Doctrine_Query {

  public function filterByPeriod($period) {
    if(is_object($period))  $id = $period->getId();
    elseif(is_null($period))  return null;
    else $id = $period;
    return $this->leftJoin($this->getRootAlias().'.Class cls')->andWhere('cls.period_id = ?', $id);
  }
  public function filterByWeek($week) {
    if(is_object($week))  $id = $week->getid();
    elseif(is_null($week))  return null;
    else $id = $week;
    return $this->leftJoin($this->getRootAlias().'.Class cls')->leftJoin('cls.Period per')->andWhere('per.week_id = ?', $id);
  }
  public function filterByScout($scout) {
    if(is_object($scout)) $id = $scout->getId();
    elseif(is_null($scout)) return null;
    else $id = $scout;
    return $this->andWhere($this->getRootAlias().'.scout_id = ?', $id);
  }
}
?>
