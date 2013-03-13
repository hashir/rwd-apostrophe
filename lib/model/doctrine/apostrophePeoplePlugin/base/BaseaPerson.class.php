<?php

/**
 * BaseaPerson
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $salutation
 * @property string $suffix
 * @property string $email
 * @property string $address_1
 * @property string $address_2
 * @property string $city
 * @property string $state
 * @property string $postal_code
 * @property string $work_phone
 * @property string $work_fax
 * @property string $body
 * @property string $link
 * @property integer $headshot_id
 * @property aMediaItem $Headshot
 * @property Doctrine_Collection $Categories
 * @property Doctrine_Collection $aPersonToACategory
 * 
 * @method string              getFirstName()          Returns the current record's "first_name" value
 * @method string              getMiddleName()         Returns the current record's "middle_name" value
 * @method string              getLastName()           Returns the current record's "last_name" value
 * @method string              getSalutation()         Returns the current record's "salutation" value
 * @method string              getSuffix()             Returns the current record's "suffix" value
 * @method string              getEmail()              Returns the current record's "email" value
 * @method string              getAddress1()           Returns the current record's "address_1" value
 * @method string              getAddress2()           Returns the current record's "address_2" value
 * @method string              getCity()               Returns the current record's "city" value
 * @method string              getState()              Returns the current record's "state" value
 * @method string              getPostalCode()         Returns the current record's "postal_code" value
 * @method string              getWorkPhone()          Returns the current record's "work_phone" value
 * @method string              getWorkFax()            Returns the current record's "work_fax" value
 * @method string              getBody()               Returns the current record's "body" value
 * @method string              getLink()               Returns the current record's "link" value
 * @method integer             getHeadshotId()         Returns the current record's "headshot_id" value
 * @method aMediaItem          getHeadshot()           Returns the current record's "Headshot" value
 * @method Doctrine_Collection getCategories()         Returns the current record's "Categories" collection
 * @method Doctrine_Collection getAPersonToACategory() Returns the current record's "aPersonToACategory" collection
 * @method aPerson             setFirstName()          Sets the current record's "first_name" value
 * @method aPerson             setMiddleName()         Sets the current record's "middle_name" value
 * @method aPerson             setLastName()           Sets the current record's "last_name" value
 * @method aPerson             setSalutation()         Sets the current record's "salutation" value
 * @method aPerson             setSuffix()             Sets the current record's "suffix" value
 * @method aPerson             setEmail()              Sets the current record's "email" value
 * @method aPerson             setAddress1()           Sets the current record's "address_1" value
 * @method aPerson             setAddress2()           Sets the current record's "address_2" value
 * @method aPerson             setCity()               Sets the current record's "city" value
 * @method aPerson             setState()              Sets the current record's "state" value
 * @method aPerson             setPostalCode()         Sets the current record's "postal_code" value
 * @method aPerson             setWorkPhone()          Sets the current record's "work_phone" value
 * @method aPerson             setWorkFax()            Sets the current record's "work_fax" value
 * @method aPerson             setBody()               Sets the current record's "body" value
 * @method aPerson             setLink()               Sets the current record's "link" value
 * @method aPerson             setHeadshotId()         Sets the current record's "headshot_id" value
 * @method aPerson             setHeadshot()           Sets the current record's "Headshot" value
 * @method aPerson             setCategories()         Sets the current record's "Categories" collection
 * @method aPerson             setAPersonToACategory() Sets the current record's "aPersonToACategory" collection
 * 
 * @package    asandbox
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseaPerson extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('a_person');
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('middle_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('salutation', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('suffix', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('address_1', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('address_2', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('city', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('state', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('postal_code', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('work_phone', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('work_fax', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('body', 'string', null, array(
             'type' => 'string',
             ));
        $this->hasColumn('link', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('headshot_id', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('aMediaItem as Headshot', array(
             'local' => 'headshot_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('aCategory as Categories', array(
             'refClass' => 'aPersonToACategory',
             'local' => 'person_id',
             'foreign' => 'category_id'));

        $this->hasMany('aPersonToACategory', array(
             'local' => 'id',
             'foreign' => 'person_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             ));
        $taggable0 = new Taggable();
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
        $this->actAs($taggable0);
    }
}