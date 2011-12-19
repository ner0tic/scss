<?php // lib/ddNavMenuRenderer.class.php
  class ddNavMenuRenderer implements ddNavMenuRendererInterface {
    public function render (ddNavMenuItem $menu) {
      $_menu = '<ul class="menu">';
      foreach($menu->getChildren() as $i) {
        if($i->isAuthorized()) {
          $_menu .= '<li class="menu-item '.($i->hasChildren()?'has-sub-menu':'').'" id="'.str_replace('_','-',$i->getName()).'-menu-item">';
          $_menu .= link_to(str_replace(' ','&nbsp;',$i->getLabel()),$i->getRoute(),$i->getParameters());
          if($menu->hasChildren()) {
            $_menu .= '<ul class="sub-menu">';
            foreach($i->getChildren() as $child) {
              if($child->isAuthorized())
                $_menu .= '<li class="menu-item">'.link_to(str_replace(' ','&nbsp;',$child->getLabel()),$child->getRoute(),$child->getParameters()).'</li>';
            }
            $_menu .= '</ul>';
          }
          $_menu .= '</li>';
        }
      }
      $_menu .= '</ul>';
      print_r($_menu);
    }
  }
