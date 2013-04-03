<?php

/**
 * This is the model class for table "mmw_users".
 *
 * The followings are the available columns in table 'mmw_users':
 * @property string $id
 * @property string $puid
 * @property string $careerAcct
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property string $lastLogin
 *
 * The following are helper methods for getting the full name in different formats:
 * @property string $fullName
 * @property string $fullNameLastFirst
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mmw_users';
	}
	
	/**
	 * @var private property containing the class to add to the HTML tag of views
	 */
	private $_htmlClass = 'user';
	
	/**
	 * @return string the class to apply to the HTML tag
	 */
	public function getHtmlClass()
	{
		return $this->_htmlClass;
	}
	
	/**
	 * @htmlClass string the class to apply to the HTML tag
	 */
	public function setHtmlClass($htmlClass)
	{
		$this->_htmlClass = $htmlClass;
	}
	
	/**
	 * @return string the name of the user as "firstName lastName".
	 */
	public function getFullName()
	{
		if(isset($this->firstName) && isset($this->lastName))
		{
			return $this->firstName . ' ' . $this->lastName;
		}
		elseif(isset($this->firstName))
		{
			return $this->firstName;
		}
		elseif(isset($this->lastName))
		{
			return $this->lastName;
		}
		return '';
	}
	
	/**
	 * @return string the name of the user as "lastName, firstName".
	 */
	public function getFullNameLastFirst()
	{
		if(isset($this->firstName) && isset($this->lastName))
		{
			return $this->lastName . ', ' . $this->firstName;
		}
		elseif(isset($this->firstName))
		{
			return $this->firstName;
		}
		elseif(isset($this->lastName))
		{
			return $this->lastName;
		}
		return '';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstName, lastName, email', 'required'),
			array('puid, careerAcct, email', 'unique'),
			array('puid, careerAcct, firstName, lastName, email', 'length', 'max'=>64),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, puid, careerAcct, firstName, lastName, email, lastLogin', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'puid' => 'Puid',
			'careerAcct' => 'Career Acct',
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'email' => 'Email',
			'lastLogin' => 'Last Login',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('puid',$this->puid,true);
		$criteria->compare('careerAcct',$this->careerAcct,true);
		$criteria->compare('firstName',$this->firstName,true);
		$criteria->compare('lastName',$this->lastName,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}