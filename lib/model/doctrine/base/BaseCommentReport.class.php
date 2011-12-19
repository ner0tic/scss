<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CommentReport', 'doctrine');

/**
 * BaseCommentReport
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $reason
 * @property string $referer
 * @property string $state
 * @property integer $id_comment
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Comment $Comment
 * 
 * @method integer       getId()         Returns the current record's "id" value
 * @method string        getReason()     Returns the current record's "reason" value
 * @method string        getReferer()    Returns the current record's "referer" value
 * @method string        getState()      Returns the current record's "state" value
 * @method integer       getIdComment()  Returns the current record's "id_comment" value
 * @method timestamp     getCreatedAt()  Returns the current record's "created_at" value
 * @method timestamp     getUpdatedAt()  Returns the current record's "updated_at" value
 * @method Comment       getComment()    Returns the current record's "Comment" value
 * @method CommentReport setId()         Sets the current record's "id" value
 * @method CommentReport setReason()     Sets the current record's "reason" value
 * @method CommentReport setReferer()    Sets the current record's "referer" value
 * @method CommentReport setState()      Sets the current record's "state" value
 * @method CommentReport setIdComment()  Sets the current record's "id_comment" value
 * @method CommentReport setCreatedAt()  Sets the current record's "created_at" value
 * @method CommentReport setUpdatedAt()  Sets the current record's "updated_at" value
 * @method CommentReport setComment()    Sets the current record's "Comment" value
 * 
 * @package    scss
 * @subpackage model
 * @author     David Durost
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCommentReport extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comment_report');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('reason', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('referer', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('state', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => 'untreated',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('id_comment', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 8,
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
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Comment', array(
             'local' => 'id_comment',
             'foreign' => 'id'));
    }
}