<?php // apps/frontend/modules/sfGuardUser/actions/components.class.php
  class sfGuardUserComponents extends sfComponents {
    public function executeRender() {
      $this->user = $this->getUser();
      $this->menu = array();
      $this->menu = sfYaml::load(sfConfig::get('sf_app_config_dir').'/'.sfConfig::get('app_menu_file'));
      foreach($this->menu as $navItemsLabel => $navItems) {
        echo "$navItemsLabel:<br />";
        foreach($navItems as $navItemLabel => $navItem){
          if(!is_array($navItem))  echo "+$navItemLabel: $navItem<br />";
          else {
            echo "+$navItemLabel:<br />";
            foreach($navItem as $childItemsLabel => $childItems) {
              echo "++$childItemsLabel:<br />";
              foreach($childItems as $childItemLabel => $childItem) {
                if(!is_array($childItem)) echo "+++$childItemLabel: $childItem<br />";
                else {
                  echo "+++$childItemLabel: <br />";
                  foreach($childItem as $babyItemsLabel => $babyItems) {
                    echo "++++$babyItemsLabel: $babyItems<br />";
                  }
                }
              }
            }
          }
        }
      }
    }
  }

