<?php

class SiteController extends CController
{
	public function actionIndex()
	{
		$model = new RequestForm;
		$data  = [];

		// collect input data
		if(isset($_POST['RequestForm']))
		{
			$model->attributes=$_POST['RequestForm'];

			if ($model->validate()) {
				$data = Yii::app()->TwitterData->getData($model->keyword);
			}
		} else {
			$data = Yii::app()->TwitterData->getData('Ukraine');
			$model->keyword = 'Ukraine';
		}

		$this->layout = "main";
		$this->render('cloud',array(
			'model' => $model,
			'data'  => $data,
			'rates' => Yii::app()->TwitterData->getSearchRates(),
		));
	}
}
