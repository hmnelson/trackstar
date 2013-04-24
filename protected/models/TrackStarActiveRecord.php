<?php

abstract class TrackStarActiveRecord extends CActiveRecord
{
	/**
	 * Prepares createTime, creatorId, updateTime, and updaterId
	 */
	protected function beforeValidate()
	{
		$this->updateTime = new CDbExpression('NOW()');
		$this->updaterId = Yii::app()->user->id;
		
		if($this->isNewRecord)
		{
			// Set the create date, last updated date, and the user doing the creating
			$this->createTime = $this->updateTime;
			$this->creatorId = $this->updaterId;
		}
		
		return parent::beforeValidate();
	}
	
}

?>