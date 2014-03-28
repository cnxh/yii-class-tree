<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionTest(){
		$result = array();
		$classes = array("CTimestamp",
"CFileHelper",
"CVarDumper",
"CMarkdownParser",
"CDateTimeParser",
"CPropertyValue",
"YiiBase",
"Yii",
// "PHPUNIT_Framework_TestCase",
// "PHPUNIT_Extensions_SeleniumTestCase",
// "CDbTestCase",
// "CDbFixtureManager",
// "CTestCase",
// "CWebTestCase",
"CWebLogRoute",
"CProfileLogRoute",
"CDbLogRoute",
"CEmailLogRoute",
"CFileLogRoute",
"CLogFilter",
"CLogRouter",
"CLogger",
"CLogRoute",
"CDbConnection",
"CDbException",
"CDbCommand",
"CDbTransaction",
"CDbDataReader",
"CActiveRecord",
"CActiveRecordBehavior",
"CBaseActiveRelation",
"CStatRelation",
"CActiveRelation",
"CActiveFinder",
"CJoinElement",
"CHasManyRelation",
"CManyManyRelation",
"CBelongsToRelation",
"CStatElement",
"CJoinQuery",
"CActiveRecordMetaData",
"CDbSchema",
"CDbExpression",
"CDbCriteria",
"CDbTableSchema",
"CDbColumnSchema",
"CDbCommandBuilder",
"CSqliteSchema",
"CMysqlSchema",
"CMysqlTableSchema",
"CSqliteColumnSchema",
"CSqliteCommandBuilder",
"CMysqlColumnSchema",
"CPgsqlSchema",
"COciSchema",
"CPgsqlTableSchema",
"CPgsqlColumnSchema",
"COciTableSchema",
"COciColumnSchema",
"COciCommandBuilder",
"CMssqlSchema",
"CMssqlTableSchema",
"CMssqlColumnSchema",
"CMssqlCommandBuilder",
"CMssqlPdoAdapter",
"CMessageSource",
"CLocale",
"CGettextFile",
"CGettextPoFile",
"CGettextMoFile",
"CDbMessageSource",
"CPhpMessageSource",
"CGettextMessageSource",
"CNumberFormatter",
"CMissingTranslationEvent",
"CChoiceFormat",
"CDateFormatter",
"CDbCache",
"CEAcceleratorCache",
"CXCache",
"CMemCache",
"CMemCacheServerConfiguration",
"CDummyCache",
"CApcCache",
"CFileCache",
"CDirectoryCacheDependency",
"CExpressionDependency",
"CFileCacheDependency",
"CZendDataCache",
"CGlobalStateCacheDependency",
"CDbCacheDependency",
"CCache",
"CChainedCacheDependency",
"CCacheDependency",
"CTypedList",
"CList",
"CAttributeCollection",
"CMap",
"CConfiguration",
"CQueue",
"CStack",
"CListIterator",
"CMapIterator",
"CStackIterator",
"CQueueIterator",
"CEmailValidator",
"CTypeValidator",
"CExistValidator",
"CCompareValidator",
"CNumberValidator",
"CFileValidator",
"CStringValidator",
"CDefaultValueValidator",
"CInlineValidator",
"CUniqueValidator",
"CCaptchaValidator",
"CRegularExpressionValidator",
"CValidator",
"CUnsafeValidator",
"CRangeValidator",
"CUrlValidator",
"CFilterValidator",
"CRequiredValidator",
"CSafeValidator",
"MessageCommand",
"ModelCommand",
"WebAppCommand",
"ShellCommand",
"ShellException",
"CrudCommand",
"ModuleCommand",
"ControllerCommand",
"HelpCommand",
"CConsoleCommand",
"CConsoleCommandRunner",
"CHelpCommand",
"CConsoleApplication",
"CDbHttpSession",
"CCacheHttpSession",
"CHttpSession",
"CHttpSessionIterator",
"CFormModel",
"COutputEvent",
"CInlineAction",
"CAction",
"CViewAction",
"CBaseController",
"CCookieCollection",
"CUploadedFile",
"CWsdlGenerator",
"CWebService",
"CWebServiceAction",
"CSoapObjectWrapper",
"CController",
"CExtController",
"CHtml",
"CWebApplication",
"CGoogleApi",
"CJavaScript",
"CJSON",
"CCaptchaAction",
"CCaptcha",
"CTreeView",
"CFlexWidget",
"CForm",
"CListPager",
"CLinkPager",
"CBasePager",
"CMultiFileUpload",
"CTabView",
"CStarRating",
"CAutoComplete",
"CClipWidget",
"CWidget",
"CInputWidget",
"CMaskedTextField",
"COutputCache",
"CMarkdown",
"COutputProcessor",
"CTextHighlighter",
"CFilterWidget",
"CHtmlPurifier",
"CAccessControlFilter",
"CBaseUserIdentity",
"CUserIdentity",
"CAuthItem",
"CAccessRule",
"CAuthAssignment",
"CDbAuthManager",
"CWebUser",
"CPhpAuthManager",
"CAuthManager",
"CUrlManager",
"CHttpRequest",
"CThemeManager",
"CAssetManager",
"CUrlRule",
"CClientScript",
"CSort",
"CPagination",
"CViewRenderer",
"CPradoViewRenderer",
"CFilter",
"CFilterChain",
"CInlineFilter",
"CHttpCookie",
"CTheme",
"CFormButtonElement",
"CWebModule",
"CFormElement",
"CFormElementCollection",
"CFormStringElement",
"CFormInputElement",
"ICacheDependency",
"ICache",
"CErrorHandler",
"CSecurityManager",
"CBehavior",
"IBehavior",
"CModelBehavior",
"CStatePersister",
"IStatePersister",
"IApplicationComponent",
"CApplicationComponent",
"CModel",
"CException",
"CHttpException",
"CExceptionEvent",
"CEvent",
"CModelEvent",
"CErrorEvent",
"CComponent",
"IAuthManager",
"CModule",
"CApplication",
"IAction",
"CEnumerable",
"IWebServiceProvider",
"IViewRenderer",
"IFilter",
"IUserIdentity",
"IWebUser",
"ArrayAccess",
"IteratorAggregate",
"Exception",
"Countable",
"Iterator",
"PDO");
		foreach($classes as $class) {
			$reflection = new ReflectionClass($class);

			$interfaces = $reflection->getInterfaceNames();
			$parentClass = $reflection->getParentClass();
			if ($parentClass !== false) {
				array_push($interfaces, $parentClass->getName());
			}

			foreach($interfaces as $interface) {
				array_push($result, array($class, $interface));
			}
			unset($reflection);
			//break;
			
		}

		$aa = '';
		foreach($result as $item) {
			echo sprintf("%s\t%s\r\n", $item[0], $item[1]);
		}
		//print_r($result);
	}
}