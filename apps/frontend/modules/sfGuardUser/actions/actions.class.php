<?php // apps/frontend/modules/sfGuardUser/actions/actions.class.php
class sfGuardUserActions extends sfActions {
  public function executeConnectFb(sfWebRequest $request) {
		$this->getUser()->connect('facebook');
	}
	public function executeFacebook(sfWebRequest $request) {
		$this->me = $this->getUser()->getMelody('facebook')->getMe();
	}
}
?>
