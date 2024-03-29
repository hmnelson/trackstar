<?php

class IssueController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	/**
	 * @var public property containing the class to add to the HTML tag of views
	 */
	public $htmlId = 'issue';
	
	/**
	 * @var private property containing the associated Project model instance.
	 */
	private $_project = null;
	
	/**
	 * @return object the Project data model instance to which this issue belongs.
	 */
	public function getProject()
	{
		return $this->_project;
	}
	
	/**
	 * Protected method to load the associate model class.
	 * @project_id the primary identifier of the associated Project
	 * @return object the Project data model based on the primary key
	 */
	protected function loadProject($projectId)
	{
		// Make sure that a project_id was specified.
		if(! $projectId)
		{
			throw new CHttpException(404, 'No project ID was specified.');
		}
		
		// if the project property is null, populate it with the Project model
		// that matches the requested project_id.
		if($this->_project === null)
		{
			$this->_project = Project::model()->findbyPk($projectId);
			if($this->_project === null)
			{
				throw new CHttpException(404, 'The requested project does not exist.');
			}
		}
		return $this->_project;
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
			'projectContext + create', // check to ensure valid project context
			'projectContext + index', // check to ensure valid project context
			'projectContext + admin', // check to ensure valid project context
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Issue;
		$model->projectId = $this->_project->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Issue']))
		{
			$model->attributes=$_POST['Issue'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Issue', array(
			'criteria'=>array(
				'condition'=>'projectId=:projectId',
				'params'=>array('projectId'=>$this->_project->id),
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Issue('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Issue']))
			$model->attributes=$_GET['Issue'];
		
		$model->projectId = $this->_project->id;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Issue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		$this->loadProject($model->projectId);
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='issue-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/** 
	 * Filter to ensure that a valid project context has been established.
	 * It is called before the actionCreate() action method is run in order to 
	 * ensure that the issue will have the necessary project context.
	 */
	public function filterProjectContext($filterChain)
	{
		// Set the project identifier based on either the GET or POST input
		// request variables, since we allow both types for our actions.
		$projectId = null;
		if(isset($_GET['pid']))
		{
			$projectId = $_GET['pid'];
		}
		elseif(isset($_POST['pid']))
		{
			$projectId = $_POST['pid'];
		}
		$this->loadProject($projectId);
		
		// complete the running of other filters and execute the requested action
		$filterChain->run();
	}
}
