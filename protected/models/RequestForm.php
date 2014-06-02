<?php

/**
 * RequestForm class.
 */
class RequestForm extends CFormModel
{
	public $keyword;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// keyword is required
			array('keyword', 'required'),
			// keyword is alphanumeric
			array('keyword', 'match',
				'pattern'    => '/^[A-Za-z0-9]+$/',
				'allowEmpty' => false,
				'message'    => 'Keyword can contain only alphanumeric characters.'
			),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'keyword'=>'Search keyword',
		);
	}
}
