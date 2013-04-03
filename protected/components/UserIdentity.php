<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Id of the user record in the database
	 */
	private $_id;
	
	public function getId()
	{
		return $this->_id;
	}
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes( array('careerAcct'=>$this->username) );
		
		if ($user === null)
		{
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		else
		{
			// Temporary password authentication; change it to use Purdue's CAS authentication
			if ( ($this->username . 'demo' !== $this->password) and ($this->username . 'admin' !== $this->password) )
			{
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
			else
			{
				$this->_id = $user->id;
				if (null === $user->lastLogin)
				{
					$lastLogin = time();
				}
				else
				{
					$lastLogin = strtotime($user->lastLogin);
				}
				$this->setState('lastLogin', $lastLogin);
				$this->errorCode = self::ERROR_NONE;
			}
			return !$this->errorCode;
		}
	}
}