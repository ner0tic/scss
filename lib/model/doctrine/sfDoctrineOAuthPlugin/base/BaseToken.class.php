<?php

/**
 * BaseToken
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property clob $token_key
 * @property clob $token_secret
 * @property integer $user_id
 * @property integer $expire
 * @property clob $params
 * @property string $identifier
 * @property string $status
 * @property integer $o_auth_version
 * @property sfGuardUser $User
 * 
 * @method integer     getId()             Returns the current record's "id" value
 * @method string      getName()           Returns the current record's "name" value
 * @method clob        getTokenKey()       Returns the current record's "token_key" value
 * @method clob        getTokenSecret()    Returns the current record's "token_secret" value
 * @method integer     getUserId()         Returns the current record's "user_id" value
 * @method integer     getExpire()         Returns the current record's "expire" value
 * @method clob        getParams()         Returns the current record's "params" value
 * @method string      getIdentifier()     Returns the current record's "identifier" value
 * @method string      getStatus()         Returns the current record's "status" value
 * @method integer     getOAuthVersion()   Returns the current record's "o_auth_version" value
 * @method sfGuardUser getUser()           Returns the current record's "User" value
 * @method Token       setId()             Sets the current record's "id" value
 * @method Token       setName()           Sets the current record's "name" value
 * @method Token       setTokenKey()       Sets the current record's "token_key" value
 * @method Token       setTokenSecret()    Sets the current record's "token_secret" value
 * @method Token       setUserId()         Sets the current record's "user_id" value
 * @method Token       setExpire()         Sets the current record's "expire" value
 * @method Token       setParams()         Sets the current record's "params" value
 * @method Token       setIdentifier()     Sets the current record's "identifier" value
 * @method Token       setStatus()         Sets the current record's "status" value
 * @method Token       setOAuthVersion()   Sets the current record's "o_auth_version" value
 * @method Token       setUser()           Sets the current record's "User" value
 * 
 * @package    scss
 * @subpackage model
 * @author     David Durost
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseToken extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('token');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('name', 'string', 127, array(
             'type' => 'string',
             'length' => 127,
             ));
        $this->hasColumn('token_key', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('token_secret', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('expire', 'integer', 11, array(
             'type' => 'integer',
             'length' => 11,
             ));
        $this->hasColumn('params', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('identifier', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('status', 'string', 127, array(
             'type' => 'string',
             'length' => 127,
             ));
        $this->hasColumn('o_auth_version', 'integer', 2, array(
             'type' => 'integer',
             'length' => 2,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}