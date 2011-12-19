<?php
  /**
   * Renders a custom menu
   * @param string $menu
   */
function render_menu($menu = null) {
  if(is_null($menu))  $menu = load_menu('menu.php');
  $nav = '<ul class="navbar menu">';
  foreach($menu as $child) {
    if(sfContext::getInstance()->getUser()->hasCredential($child->getCredentials())) {
      $nav .= '<li class="menu-item '.($child->hasChildren()?'has-sub-menu':'').'" id="'.Scss::slugify($child->getName()).'-menu-item">'.$child->renderLink();//link_to($child->getName(),$child->getRoute(),$child->getLinkOptions());
      if($child->hasChildren()) {
        $nav .= '<ul class="sub-menu">';
        foreach($child as $baby) {
          if($baby->checkUserAccess()) {
            $nav .= '<li class="menu-item" id="'.Scss::slugify($baby->getName()).'">'.link_to($baby->getName(),$baby->getRoute(),$baby->getLinkOptions()).'</li>';
          }
        }
        $nav .= '</ul>';
      }
      $nav .= '</li>';
    }
  }
  $nav .= '</ul>';
  print_r($nav);
}
  /**
   * Loads a menu from a config file
   */
function load_menu($file = null,$dir = null) {
  if(is_null($file))  $file = sfConfig::get('app_menu_file');
  if(is_null($dir))   $dir = sfConfig::get('sf_app_config_dir').'/';
  if(strpos($file,'.yml')!= false) {
    $arr = sfYaml::load($dir.$file);
    $menu = ddNavMenuItem::createFromArray($arr);
  }
  else include_once($dir.$file);
  return $menu;
}
