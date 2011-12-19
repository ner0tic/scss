<?php
/**
  * ddSessionStorageUploadify class
  * 
  * This class allows for flash to transfer the session_id. Special thanks
  * to disturbed and other users on the forums.
  * Based on plUploadifyPlugin by Chris LeBlanc <chris@webPragmatist.com>
  *
  * @package ddAdvancedImageUploaderPlugin
  * @author ner0tic <david.durost@gmail.com>
  * @see http://forum.symfony-project.org/index.php/m/79016/
*/
class ddSessionStorageUploadify extends sfSessionStorage
{
  public function initialize($options = null)
  {

    if($this->transSidFor(sfContext::getInstance()->getRequest()))
    { 
      $sessionName = isset($options['session_name']) ? $options['session_name'] : 'symfony' ;

      if($value = sfContext::getInstance()->getRequest()->getParameter($sessionName))
      {
        if (sfConfig::get('sf_logging_enabled'))
        {
          sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent($this, 'application.log', array(sprintf('Changing session name "%s" to "%s"', $sessionName, $value))));
        }
        session_name($sessionName);
        session_id($value);
      } 
    }

    parent::initialize($options);
  }

  /**
    * Checks if changing of session id is enabled for current module and action.
    * Enabled pairs are set in "app_storage_trans_sid_for" array.
    *  - To enable specific action, add "moduleName/actionName".
    *  - To enable whole module add "moduleName".
    * @return boolean
    */
  private function transSidFor(sfWebRequest $request)
  {
    $for = sfConfig::get("app_ddAdvancedImageUploader_enabled_routes");
    if(!is_array($for) || !$for)
    {
      return false;
    }
    return in_array($request->getParameter("module"), $for) || in_array($request->getParameter("module")."/".$request->getParameter("action"), $for);
  }
}