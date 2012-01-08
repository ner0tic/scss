<?php

class myUser extends ddFacebookUser
//class myUser extends sfMelodyUser
{
  /**
   * Returns whether or not the user has the given credential.
   * While skipping the super_user bypass
   *
   * @param string $credential The credential name
   * @param boolean $useAnd Whether or not to use an AND condition
   * @return boolean
   */
  public function checkCredential($credential, $useAnd = true) {
    if(empty($credential)) return true;
    if(!$this->getGuardUser()) return false;
    if(is_null($this->GetGroups()))  return false;
    return $this->hasGroup($credential);
  }
  /**
   *
   * @param type $credentials
   * @param type $useAnd
   * @return type 
   */
  public function checkCredentials($credentials, $useAnd = true) {
    $bool = false;
    foreach($credentials as $credential)  $bool = $this->checkCredential($credential,$useAnd);
    return $bool;
  }
  
  /**
   *
   * determines the avatar and returns the path
   * @return string  
   */
  public function getAvatar() {
  // if a custom avatar has been uploaded
    if(!is_null($this->getProfile()->getAvatar()))  return sfConfig::get('app_avatar_upload_dir').'/'.$this->getProfile()->getAvatar();
  // if the user's account is synced with facebook    
    if(!is_null($this->getProfile()->getFacebookUid())) {
      $avatar = $this->getFacebook()->api(array('method' => 'fql.query', 'query' => "SELECT pic_square FROM user WHERE uid = ".$this->getProfile()->getFacebookUid()));
      return $avatar[0]['pic_square'];
    }
   // default
    return sfConfig::get('app_avatar_default_img');
  }
}
