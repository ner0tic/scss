<?php

require_once '/home/ner0tic/libraries/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfFacebookConnectPlugin');
    $this->enablePlugins('sfFormExtraPlugin');
    $this->enablePlugins('sfAssetsManagerPlugin');
    $this->enablePlugins('sfDoctrineOAuthPlugin');
    $this->enablePlugins('ddNavMenuPlugin');
    $this->enablePlugins('ddLightboxPlugin');
    $this->enablePlugins('ddWidgetFormInputToggleSwitchPlugin');
  }
}
