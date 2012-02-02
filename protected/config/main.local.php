<?php
return CMap::mergeArray(
	require('main.php'),
	array(
		'components'=>array(
			'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=backstage',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning',
					),
					array(
						'class'=>'CWebLogRoute',
						'categories'=>'system.db.CDbCommand',
						'showInFireBug'=>true,
					),
				),
			),
		)
	)
);
?>