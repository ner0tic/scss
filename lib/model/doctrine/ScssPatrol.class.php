<?php

/**
 * ScssPatrol
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    scss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ScssPatrol extends BaseScssPatrol
{
    public function getScouts() {
        $q = Doctrine::getTable('scssScout')->createQuery('s')->where('s.patrol_id = ?', $this->getId());
        $r = $q->execute();
        return $r;
    }
    public function getScoutCount() {
        return $this->getScouts()->count();
    }
}
