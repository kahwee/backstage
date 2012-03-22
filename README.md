Backstage - Easy admin interface for Yii
========================================

What is Backstage?
------------------

Backstage is a Yii Framework module that is easily deployable and can be used for scaffolding.


How to make it work
-------------------

Deploy it by placing it Backstage into `protected/modules/backstage`.

And in your `./protected/config/main.php`, add `backstage` to begin:

```php
<?php
return array(
  'modules' => array(
  	'backstage' => array(),
	),
);
```

Go to the website http://localhost/index.php?r=backstage to view Backstage.

More advance usage
------------------

For more advance usage, here is an example.

```php
<?php
return array(
  'modules' => array(
		'backstage' => array(
			'class' => 'application.modules.backstage.BackstageModule',
			#'autoloadModels' => false,
			'name' => 'Backstage',
			'copyright_name' => 'Backstage, Inc.'
			'models' => array(
				'Tag' => array(
					'id' => array(
						'control' => 'datetime',
						'visible' => true,
						'format'=>'M j, Y g:i A',
					),
				),
				'User' => false,
				'Article' => array(
					'content' => array(
						'control' => 'richtext',
					),
					'create_by' => array(
						'control' => 'relation',
					),
					'create_time' => array(
						'visible' => array('index', 'search'),
						'locked' => array('update'),
					),
				),
			)
		),
	),
);
```

Issues?
-------

If you have any issues, please highlight them in [Backstage's GitHub issues](https://github.com/kahwee/backstage/issues).
