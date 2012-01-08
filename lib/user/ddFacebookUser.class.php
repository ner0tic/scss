<?php

class ddFacebookUser extends sfGuardSecurityUser {
  protected $fb = null;
  
  public function getFacebook() {
    if(!is_null($this->fb)) return $this->fb;
    $this->fb = new Facebook(array(
        'appId'  => sfConfig::get('app_facebook_api_id'),
        'secret' => sfConfig::get('app_facebook_api_secret'),
        'cookie' => true
      ));
    return $this->fb;
  }
}
?>
