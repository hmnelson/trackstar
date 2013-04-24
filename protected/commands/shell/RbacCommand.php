<?php

class RbacCommand extends CConsoleCommand
{
	
	private $_authManager;
	
	public function getHelp()
	{
		return <<<EOD
USAGE
	rbac
		
DESCRIPTION
	This command generates an initial RBAC authorization hierarchy.
	
	The hierarchy covers 5 modules: 4 applications and one set of global tables 
	used by all the applications.
	
	Each module has two or more tables that require authorization operations 
	and roles defined for them.
	
	Operations are table-specific, so the naming convention for operation authorization 
	items will be a lowercase, two- or three-letter abbreviation signifying the module 
	(and matching the prefix used to name the database tables), followed by the name 
	of the table and the name of the operation or role, in camelcase. For example, 
	the authorization item  for creating a new record in the Students table of the 
	Five Students module would be 5sStudentsCreate.
	
	Roles are module-specific, so the naming convention will omit the table names.
	The authorization item names will be simply the module prefix followed by the role
	name. For instance, the writer role in the Events module would be keWriter.
	
	The module/table roots for the authorization items are as follows...
	
	Five Students:
		5sMonths
		5sStudents
	
	Events
		keEvents
		keLocations
	
	Guestbook
		kgVisitors
	
	Campus Vibe
		kvPosts
		kvWatchlist
		kvCampaigns
	
	Global
	  mmwImages
		mmwUsers
	
		
EOD;
	}
	
	/**
	 * Execute the action.
	 * @param array command line parameters specific for this command
	 */
	public function run($args)
	{		
		// ensure that an authManager is defined as this is mandatory for creating an auth hierarchy
		if (($this->_authManager=Yii::app()->authManager) === null)
		{
			echo "Error: an authorization manager named 'authManager' must be configured to use this command.\n";
			echo "If you already added the 'authManager' component in the application configuration,\n";
			echo "please quit and re-enter the yiic shell.\n";
			return;
		}
		
		// provide the opportunity for the user to abort the request
		echo "This command will create three roles: Owner, Member, and Reader, and the following permissions:\n";
		echo "create, read, update and delete user\n";
		echo "create, read, update and delette project\n";
		echo "create, read, update and delete issue\n";
		echo "Would you like to continue? [ Yes | No ]";
		
		// check the input from the user and continue if they indicated yes to the above question
		if (!strncasecmp(trim(fgets(STDIN)), 'y', 1))
		{
			// first we need to remove all operations, roles, child relationships and assignments
			$this->_authManager->clearAll();
			
			// create the lowest-level operations for users
			$this->_authManager->createOperation("createUser","Create a new user");
			$this->_authManager->createOperation("readUser","Read user profile information");
			$this->_authManager->createOperation("updateUser","Update a user's information");
			$this->_authManager->createOperation("deleteUser","Remove a user from a project");
			
			// create the lowest-level operations for projects
			$this->_authManager->createOperation("createProject","Create a new project");
			$this->_authManager->createOperation("readProject","Read project information");
			$this->_authManager->createOperation("updateProject","Update project information");
			$this->_authManager->createOperation("deleteProject","Delete a project");
			
			// create the lowest-level operations for issues
			$this->_authManager->createOperation("createIssue","Create a new issue");
			$this->_authManager->createOperation("readIssue","Read issue information");
			$this->_authManager->createOperation("updateIssue","Update issue information");
			$this->_authManager->createOperation("deleteIssue","Delete an issue from a project");
			
			// create the reader role and add the appropriate permissions as children to the role
			$role = $this->_authManager->createRole("projectReader");
			$role->addChild("readUser");
			$role->addChild("readProject");
			$role->addChild("readIssue");
			
			// create the member role and add the appropriate permissions, as well as the reader role, as children
			$role = $this->_authManager->createRole("projectMember");
			$role->addChild("projectReader");
			$role->addChild("createIssue");
			$role->addChild("updateIssue");
			$role->addChild("deleteIssue");
			
			// create the owner role and add the appropriate permissions, adding them and the reader adn member roles as children
			$role = $this->_authManager->createRole("projectOwner");
			$role->addChild("projectReader");
			$role->addChild("projectMember");
			$role->addChild("createUser");
			$role->addChild("updateUser");
			$role->addChild("deleteUser");
			$role->addChild("createProject");
			$role->addChild("updateProject");
			$role->addChild("deleteProject");
			
			// provide a message indicating success
			echo "Authorization hierarchy successfully generated.";
			
		}
	}
}
