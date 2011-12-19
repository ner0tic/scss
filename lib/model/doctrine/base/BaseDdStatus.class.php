<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DdStatus', 'doctrine');

/**
 * BaseDdStatus
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $color
 * @property string $image
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property string $slug
 * @property Doctrine_Collection $DdPortfolio
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getColor()       Returns the current record's "color" value
 * @method string              getImage()       Returns the current record's "image" value
 * @method timestamp           getCreatedAt()   Returns the current record's "created_at" value
 * @method timestamp           getUpdatedAt()   Returns the current record's "updated_at" value
 * @method string              getSlug()        Returns the current record's "slug" value
 * @method Doctrine_Collection getDdPortfolio() Returns the current record's "DdPortfolio" collection
 * @method DdStatus            setId()          Sets the current record's "id" value
 * @method DdStatus            setName()        Sets the current record's "name" value
 * @method DdStatus            setColor()       Sets the current record's "color" value
 * @method DdStatus            setImage()       Sets the current record's "image" value
 * @method DdStatus            setCreatedAt()   Sets the current record's "created_at" value
 * @method DdStatus            setUpdatedAt()   Sets the current record's "updated_at" value
 * @method DdStatus            setSlug()        Sets the current record's "slug" value
 * @method DdStatus            setDdPortfolio() Sets the current record's "DdPortfolio" collection
 * 
 * @package    scss
 * @subpackage model
 * @author     David Durost
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDdStatus extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dd_status');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('color', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('image', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('slug', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('DdPortfolio', array(
             'local' => 'id',
             'foreign' => 'status_id'));
    }
}