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
	 * Returns the list of project roles (roles whose names start with "project")
	 */
	public static function getUserRoleOptions()
	{
		$roles = preg_filter('/project.+/', '$0', array_keys(Yii::app()->authManager->getRoles()));
		$filteredRoles = array();
		foreach($roles as $role)
		{
			$filteredRoles[] = array('name'=>$role, 'value'=>$role);
		}
		$rolesArray = CHtml::listData($filteredRoles, 'name', 'value');
		return $rolesArray;
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
	 * Creates an association between the project and a user
	 */
	public function associateUserToProject($userId)
	{
		$sql = "insert into ts_project_user (projectId, userId, createUserId) values (:projectId, :userId, :createUserId)";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':projectId', $this->id, PDO::PARAM_INT);
		$command->bindValue(':userId', $userId, PDO::PARAM_INT);
		$command->bindValue(':createUserId',Yii::app()->user->getId(), PDO::PARAM_INT);
		return $command->execute();
	}
	
	/**
	 * @return boolean whether a user is associated with the project
	 */
	public function isUserInProject($userId)
	{
		$sql = "select userId from ts_project_user where projectId=:projectId and userId=:userId";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':projectId', $this->id, PDO::PARAM_INT);
		$command->bindValue(':userId', $userId, PDO::PARAM_INT);
		return $command->execute() == 1 ? true : false;
	}
	
	/**
	 * Removes the association between the project and a user
	 */
	public function removeUserFromProject($userId)
	{
		$sql = "delete from ts_project_user where projectId=:projectId and userId=:userId";
		$command = Yii::app()->db->createCommand($sql);
		$command.bindValue(':projectId', $this->id, PDO::PARAM_INT);
		$command.bindValue(':userId', $userId, PDO::PARAM_INT);
		$command->execute();
	}
	
	/*
	 * Creates an association between the project, the user, and the user's role within the project
	 */
	public function associateUserToRole($userId, $role)
	{
		$sql = "insert into ts_project_user_role (projectId, userId, role) values (:projectId, :userId, :role)";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':projectId', $this->id, PDO::PARAM_INT);
		$command->bindValue(':userId', $userId, PDO::PARAM_INT);
		$command->bindValue(':role', $role, PDO::PARAM_STR);
		return $command->execute();
	}
	
	/**
	 * @return boolean whether the current user is in the specified role within the context of this project
	 */
	public function isUserInRole($role)	
	{
		$sql = "select role from ts_project_user_role where projectId=:projectId and userId=:userId and role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':projectId', $this->id, PDO::PARAM_INT);
		$command->bindValue(':userId', Yii::app()->user->getId(), PDO::PARAM_INT);
		$command->bindValue(':role', $role, PDO::PARAM_STR);
		return $command->execute() == 1 ? true : false;
	}
	
	/**
	 * rmoves an association between the project, the user, and the user's role within the project
	 */
	public function removeUserFromRole($userId, $role)
	{
		$sql = "delete from ts_project_user_role where projectId=:projectId and userId=:userId and role=:role";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindValue(':projectId', $this->id, PDO::PARAM_INT);
		$command->bindValue(':userId', $userId, PDO::PARAM_INT);
		$command->bindValue(':role', $role, PDO::PARAM_STR);
		return $command->execute();
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