<?php

$originConfig = require(dirname(__FILE__).'/main.php');

return CMap::mergeArray(
	$originConfig,
	array(
		'components' => array(
			'Twt' => array(
	            'class' => 'application.tests.unit.TwtMock',
			),
			'TwtOrigin' => $originConfig['components']['Twt'],
		),
	)
);
