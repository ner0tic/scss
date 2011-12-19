<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('DdPortfolioCommit', 'doctrine');

/**
 * BaseDdPortfolioCommit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $commit_msg
 * @property integer $portfolio_id
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property DdPortfolio $DdPortfolio
 * 
 * @method integer           getId()           Returns the current record's "id" value
 * @method string            getCommitMsg()    Returns the current record's "commit_msg" value
 * @method integer           getPortfolioId()  Returns the current record's "portfolio_id" value
 * @method timestamp         getCreatedAt()    Returns the current record's "created_at" value
 * @method timestamp         getUpdatedAt()    Returns the current record's "updated_at" value
 * @method DdPortfolio       getDdPortfolio()  Returns the current record's "DdPortfolio" value
 * @method DdPortfolioCommit setId()           Sets the current record's "id" value
 * @method DdPortfolioCommit setCommitMsg()    Sets the current record's "commit_msg" value
 * @method DdPortfolioCommit setPortfolioId()  Sets the current record's "portfolio_id" value
 * @method DdPortfolioCommit setCreatedAt()    Sets the current record's "created_at" value
 * @method DdPortfolioCommit setUpdatedAt()    Sets the current record's "updated_at" value
 * @method DdPortfolioCommit setDdPortfolio()  Sets the current record's "DdPortfolio" value
 * 
 * @package    scss
 * @subpackage model
 * @author     David Durost
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseDdPortfolioCommit extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('dd_portfolio_commit');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('commit_msg', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('portfolio_id', 'integer', 8, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
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
        $this->hasOne('DdPortfolio', array(
             'local' => 'portfolio_id',
             'foreign' => 'id'));
    }
}