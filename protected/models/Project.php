<?php

/**
 * This is the model class for table "{{project}}".
 *
 * The followings are the available columns in table '{{project}}':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $createTime
 * @property string $creatorId
 * @property string $updateTime
 * @property string $updaterId
 *
 * The followings are the available model relations:
 * @property Issue[] $issues
 * @property User[] $users
 * @property User $creator
 * @property User $updater
 */
class Project extends TrackStarActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return '{{project}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		  array('name', 'required', 'on'=>'insert, update'),
			array('name', 'length', 'max'=>128),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, createTime, creatorId, updateTime, updaterId', 'safe', 'on'=>'search'),
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
			'issues' => array(self::HAS_MANY, 'Issue', 'projectId'),
			'users' => array(self::MANY_MANY, 'User', '{{project_user}}(projectId, userId)'),
			'creator' => array(self::BELONGS_TO, 'User', 'creatorId'),
			'updater' => array(self::BELONGS_TO, 'User', 'updaterId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'description' => 'Description',
			'createTime' => 'Create Time',
			'creatorId' => 'Creator',
			'updateTime' => 'Update Time',
			'updaterId' => 'Updater',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('creatorId',$this->creatorId, true);
		$criteria->compare('updateTime',$this->updateTime,true);
		$criteria->compare('updaterId',$this->updaterId, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * @return array of valid users for this project, indexed by user IDs.
	 */
	public function getUserOptions()
	{
		$usersArray = CHtml::listData($this->users, 'id', 'fullNameLastFirst');
		return $usersArray;
	}
}