<?php

class SiteController extends CController
{
	public function actionIndex()
	{
		$model = new RequestForm;
		$data  = [];

		if (isset($_POST['RequestForm'])) {
			$model->attributes=$_POST['RequestForm'];
		} else {
			// Setting default keyword
			$model->keyword = 'Ukraine';
		}

		if ($model->validate()) {
			$data = Yii::app()->TwitterData->getData($model->keyword);
		} else {
			// If someone hacks javascript and posts incorrect keyword
			$data = Yii::app()->TwitterData->getData('Ukraine');
			$model->keyword = 'Ukraine';
		}

		$this->layout = "main";
		$this->render('index',array(
			'model' => $model,
			'data'  => $data,
			'rates' => Yii::app()->TwitterData->getSearchRates(),
		));
	}
}
