<?php

class myUser extends sfFacebookUser
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
  public function checkCredentials($credentials, $useAnd = true) {
    $bool = false;
    foreach($credentials as $credential)  $bool = $this->checkCredential($credential,$useAnd);
    return $bool;
  }
}
