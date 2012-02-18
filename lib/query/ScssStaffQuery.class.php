<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssStaffQuery extends Doctrine_Query {

  public function filterByCamp($camp) {
    if(is_object($camp))  $id = $camp->getId();
    elseif(is_number($camp))  $id = $camp;
    else  return null;
    return $this->leftJoin($this->getRootAlias().'.Cabin cb')->andWhere('cb.camp_id = ?', $id);
  }
  
  public function filterByDistrict($district) {
    if(is_object($district))  $id = $district->getId();
    elseif(is_number($district))  $id = $district;
    else return null;
    
    return $this->andWhere($this->getRootAlias().'.district_id = ?', $id);   
  }
  
  public function filterByZone($zone) {
    if(is_object($zone))  $id = $zone->getId();
    elseif(is_number($zone))  $id = $zone;
    else return null;
    
    return $this->leftJoin('District d')->andWhere('d.zone_id = ?', $id);   
  }
  
  public function filterBycountry($country) {
    if(is_object($country))  $id = $country->getId();
    elseif(is_number($country))  $id = $country;
    else return null;
    
    return $this->leftJoin($this->getRootAlias().'.District d')->leftJoin('d.Zone z')->andWhere('z.country_id = ?', $id);   
  }  
  
  public function addAgeSelect() {
    return $this->select($this->getRootAlias().".*,DATE_FORMAT(FROM_DAYS(TO_DAYS(NOW())-TO_DAYS(".$this->getRootAlias().".dob)), '%Y')+0 AS age");
  }
}

?>
