<?php

/**
 * This is the model class for table "{{issue}}".
 *
 * The followings are the available columns in table '{{issue}}':
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $projectId
 * @property string $typeId
 * @property string $statusId
 * @property string $ownerId
 * @property string $requesterId
 * @property string $createTime
 * @property string $creatorId
 * @property string $updateTime
 * @property string $updaterId
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property User $requester
 * @property User $owner
 * @property User $creator
 * @property User $updater
 */
class Issue extends TrackStarActiveRecord
{
	const TYPE_BUG = 0;
	const TYPE_FEATURE = 1;
	const TYPE_TASK = 2;
	
	const STATUS_NOT_YET_STARTED = 0;
	const STATUS_STARTED = 1;
	const STATUS_FINISHED = 2;
	
	/** 
	 * @return array issue type names indexed by type IDs
	 */
	public function getTypeOptions()
	{
		return array(
			self::TYPE_BUG => 'Bug',
			self::TYPE_FEATURE => 'Feature',
			self::TYPE_TASK => 'Task',
		);
	}
	
	/** 
	 * @return string issue type
	 */
	public function getType()
	{
		$typeOptions = $this->typeOptions;
		
		return isset($typeOptions[$this->typeId]) ? $typeOptions[$this->typeId] : 'Unknown type ({$this->typeId})';
	}
	 
	/** 
	 * @return array status names indexed by status IDs
	 */
	public function getStatusOptions()
	{
		return array(
			self::STATUS_NOT_YET_STARTED => 'Not yet started',
			self::STATUS_STARTED => 'Started',
			self::STATUS_FINISHED => 'Finished',
		);
	}
	
	/** 
	 * @return string issue status
	 */
	public function getStatus()
	{
		$statusOptions = $this->getStatusOptions();
		
		return isset($statusOptions[$this->statusId]) ? $statusOptions[$this->statusId] : 'Unknown status ({$this->statusId})';
	}
	
	/** 
	 * @return string owner name
	 */
	 public function getOwnerName()
	 {
		 return $this->owner->fullName;
	 }
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Issue the static model class
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
		return '{{issue}}';
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
			array('name', 'length', 'max'=>256),
			array('description', 'length', 'max'=>2000),
			array('projectId, typeId, statusId, ownerId, requesterId', 'length', 'max'=>10),
			array('projectId, typeId, statusId, ownerId, requesterId', 'numerical', 'integerOnly'=>true),
			array('createTime, updateTime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, projectId, typeId, statusId, ownerId, requesterId, createTime, creatorId, updateTime, updaterId', 'safe', 'on'=>'search'),
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
			'requester' => array(self::BELONGS_TO, 'User', 'requesterId'),
			'project' => array(self::BELONGS_TO, 'Project', 'projectId'),
			'owner' => array(self::BELONGS_TO, 'User', 'ownerId'),
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
			'projectId' => 'Project',
			'typeId' => 'Type',
			'statusId' => 'Status',
			'ownerId' => 'Owner',
			'requesterId' => 'Requester',
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
		$criteria->compare('projectId',$this->projectId,true);
		$criteria->compare('typeId',$this->typeId,true);
		$criteria->compare('statusId',$this->statusId,true);
		$criteria->compare('ownerId',$this->ownerId,true);
		$criteria->compare('requesterId',$this->requesterId,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('creatorId',$this->creatorId,true);
		$criteria->compare('updateTime',$this->updateTime,true);
		$criteria->compare('updaterId',$this->updaterId,true);
		$criteria->condition='projectId=:projectId';
		$criteria->params=array(':projectId'=>$this->projectId);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}