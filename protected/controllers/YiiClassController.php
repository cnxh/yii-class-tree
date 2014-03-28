<?php

class YiiClassController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	public function actionTree(){
		$sql = "select * from {{yii_class}} where name not in (select sub_class from {{yii_class_relation}})";
		$command = Yii::app()->db->createCommand($sql);
		$data = $command->queryAll();
		$this->render('tree',array(
			'data'=>$data,
		));
	}

	public function actionAjax($parentClassName){
		$sql = "select sub_class from {{yii_class_relation}} where parent_class = :parent";
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(":parent", $parentClassName, PDO::PARAM_STR);
		$data = $command->queryColumn();
		echo CJSON::encode($data);
	}
}
