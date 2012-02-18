<?php

/*
 * A custom query to add query filtering on the flye
 *
 * @author ner0tic
 */
class ScssCampQuery extends Doctrine_Query {

  public function filterByDistrict($district) {
    if(is_object($district))  $id = $district->getId();
    elseif(is_number($district))  $id = $district;
    else return null;
    
    return $this->andWhere($this->getRootAlias().'.district_id = ?', $id);   
  }
  public function filterByDistrictSlug($slug) {
    if(!is_string($slug)) return null;
    return $this->getJoin($this->getRootAlias().'.District d')->andWhere('d.slug = ?', $slug);
  }
  
  public function filterByZone($zone) {
    if(is_object($zone))  $id = $zone->getId();
    elseif(is_number($zone))  $id = $zone;
    else return null;
    
    return $this->leftJoin($this->getRootAlias().'.District d')->andWhere('d.zone_id = ?', $id);   
  }
  public function filterByZoneSlug($slug) {
    if(!is_string($slug)) return null;
    return $this->getJoin($this->getRootAlias().'.District d')->leftJoin('d.Zone z')->andWhere('z.slug = ?', $slug);
  }
  
  public function filterBycountry($country) {
    if(is_object($country))  $id = $country->getId();
    elseif(is_number($country))  $id = $country;
    else return null;
    
    return $this->leftJoin($this->getRootAlias().'.District d')->leftJoin('d.Zone z')->andWhere('z.country_id = ?', $id);   
  }
  public function filterByCountrySlug($slug) {
    if(!is_string($slug)) return null;
    return $this->getJoin($this->getRootAlias().'.District d')->leftJoin('d.Zone z')->leftJoin('z.Country y')->andWhere('y.slug = ?', $slug);
  }  
}

?>
