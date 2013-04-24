<?php

/**
 * ProjectUserForm class.
 * ProjectUserForm is the data structure for associating a user with a
 * project. It's used by the 'addUser' action of 'ProjectController'.
 */
class ProjectUserForm extends CFormModel
{
	/**
	 * @var string username of the user being added to the project
	 */
	public $username;
	
	/**
	 * @var string the role to which the user will be associated
	 */
	public $role;
	
	/**
	 * @var object an instance of the Project AR model class
	 */
	public $project;

	/**
	 * Declares the validation rules.
	 * The rules state that username and role are required,
	 * and the username needs to be verified.
	 */
	public function rules()
	{
		return array(
			// username and role are required
			array('username, role', 'required'),
			// username has to be in the database
			array('username', 'exist', 'className'=>'User', 'attributeName'=>'careerAcct'),
			// username needs to be verified
			array('username', 'verify'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Username',
			'role'=>'Role',
		);
	}

	/**
	 * Verifies the username.
	 * This is the 'verify' validator as declared in rules().
	 */
	public function verify($attribute,$params)
	{
		if(!$this->hasErrors()) // we only want to verify if there are no other input errors
		{
			$user = User::model()->findByAttributes( array('careerAcct'=>$this->username) );
			if(!$user)
				$this->addError('username','Username not found.');
			if ($this->project->isUserInProject($user->id))
			{
				$this->addError('username', 'This user has already been added to the project.');
			}
			else
			{
				$this->project->associateUserToProject($user->id);
				$this->project->associateUserToRole($user->id, $this->role);
				Yii::app()->authManager->assign($this->role, $user->id);
			}
		}
	}
}
