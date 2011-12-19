<?php

/**
 * BaseScssTroopEnrollment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $troop_id
 * @property integer $week_id
 * @property integer $site_id
 * @property integer $rotation_id
 * @property ScssTroop $Troop
 * @property ScssWeek $Week
 * @property ScssCampsite $Campsite
 * @property ScssTroopRotation $Rotation
 * 
 * @method integer             getTroopId()     Returns the current record's "troop_id" value
 * @method integer             getWeekId()      Returns the current record's "week_id" value
 * @method integer             getSiteId()      Returns the current record's "site_id" value
 * @method integer             getRotationId()  Returns the current record's "rotation_id" value
 * @method ScssTroop           getTroop()       Returns the current record's "Troop" value
 * @method ScssWeek            getWeek()        Returns the current record's "Week" value
 * @method ScssCampsite        getCampsite()    Returns the current record's "Campsite" value
 * @method ScssTroopRotation   getRotation()    Returns the current record's "Rotation" value
 * @method ScssTroopEnrollment setTroopId()     Sets the current record's "troop_id" value
 * @method ScssTroopEnrollment setWeekId()      Sets the current record's "week_id" value
 * @method ScssTroopEnrollment setSiteId()      Sets the current record's "site_id" value
 * @method ScssTroopEnrollment setRotationId()  Sets the current record's "rotation_id" value
 * @method ScssTroopEnrollment setTroop()       Sets the current record's "Troop" value
 * @method ScssTroopEnrollment setWeek()        Sets the current record's "Week" value
 * @method ScssTroopEnrollment setCampsite()    Sets the current record's "Campsite" value
 * @method ScssTroopEnrollment setRotation()    Sets the current record's "Rotation" value
 * 
 * @package    scss
 * @subpackage model
 * @author     David Durost
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseScssTroopEnrollment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('scss_troop_enrollment');
        $this->hasColumn('troop_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('week_id', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('site_id', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('rotation_id', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('ScssTroop as Troop', array(
             'local' => 'troop_id',
             'foreign' => 'id'));

        $this->hasOne('ScssWeek as Week', array(
             'local' => 'week_id',
             'foreign' => 'id'));

        $this->hasOne('ScssCampsite as Campsite', array(
             'local' => 'site_id',
             'foreign' => 'id'));

        $this->hasOne('ScssTroopRotation as Rotation', array(
             'local' => 'rotation_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}