<?php

class BackstageHelper {

	/**
	 * Discovers what is in 'application.models' path.
	 *
	 * @return array Names of all models in 'application.models'
	 */
	public static function getModels() {
		$models_path = Yii::getPathOfAlias('application.models');
		$model_names = array();
		$model_files = CFileHelper::findFiles($models_path, array(
				'level' => 0,
				'fileTypes' => array('php'),
			));
		foreach ($model_files as $model_file) {
			$model_name = str_replace(DIRECTORY_SEPARATOR, '', str_replace('.php', '', str_replace($models_path, '', $model_file)));
			if (method_exists($model_name, 'model')) {
				$model_names[$model_name] = array();
			}
		}
		return $model_names;
	}

	/**
	 * Gets the related attributes for BelongsTo relation.
	 *
	 * @param object $model Model, if in CGridView column, this will be $data.
	 * @param string $attribute Name of the field.
	 * @return string Link if relation works, plain attribute value if doesn't.
	 */
	public static function getRelatedAttribute($model, $attribute) {
		$belongsToRelation = self::findModelBelongsTo($model, $attribute);
		$belongsToRelationKeys = array_keys($belongsToRelation);
		$belongsToRelationKey = array_shift($belongsToRelationKeys);

		$link_text = null;
		if (isset($model->$belongsToRelationKey) && $belongsToModel = $model->$belongsToRelationKey->find()) {
			$belongsToModelAttributes = $model->{$belongsToRelationKey}->attributes;
			if (isset($belongsToModelAttributes['display_name'])) {
				$link_text = $belongsToModelAttributes['display_name'];
			} elseif (isset($belongsToModelAttributes['name'])) {
				$link_text = $belongsToModelAttributes['name'];
			} elseif (isset($belongsToModelAttributes['title'])) {
				$link_text = $belongsToModelAttributes['title'];
			} else {
				$link_text = $belongsToModelAttributes['id'];
			}
		}
		if (empty($link_text)) {
			return $model->{$attribute};
		} else {
			return CHtml::link($link_text, array('model/view', 'name' => $belongsToRelation[$belongsToRelationKey][1], 'id' => $model->{$belongsToRelationKey}->id));
		}
	}

	/**
	 * Gets the most likely display name attribute.
	 *
	 * @param object $model Model, instantiated
	 */
	public static function getDisplayNameAttribute($model) {
		$attributes = array_keys($model->attributes);
		$attribute_names = array('display_name', 'name', 'title');
		foreach ($attribute_names as $attribute_name) {
			if ($model->hasAttribute($attribute_name)) {
				return $attribute_name;
			}
		}
		return self::getPrimaryKey($model);
	}

	/**
	 * Gets the primary key of the model
	 *
	 * @param object $model Model, instantiated
	 */
	public static function getPrimaryKey($model) {
		$pk = $model->primaryKey();
		if (is_null($pk)) {
			$table = $model->getMetaData()->tableSchema;
			return $table->primaryKey;
		}
		return $pk;
	}

	/**
	 * Gets all the belongsTo array based on the attribute.
	 *
	 * @param object $model
	 * @param string $attribute
	 * @return array
	 */
	public static function findAllModelBelongsTo($model, $attribute=null) {
		$out = array();
		foreach ($model->relations() as $k => $v) {
			if (isset($v[0]) && $v[0] == 'CBelongsToRelation') {
				if (is_null($attribute)) {
					$out[] = array($k => $v);
				} elseif (isset($v[2]) && strcasecmp($v[2], $attribute) === 0) {
					$out[] = array($k => $v);
				}
			}
		}
		return $out;
	}

	/**
	 * Gets the first belongsTo array based on the attribute.
	 *
	 * @param object $model
	 * @param string $attribute
	 * @return array
	 */
	public static function findModelBelongsTo($model, $attribute=null) {
		$belongsToRelation = self::findAllModelBelongsTo($model, $attribute);
		return $belongsToRelation[0];
	}

	/**
	 * Checks if the string ends with
	 *
	 * @author KahWee Teng <t@kw.sg>
	 * @param string $haystack The string to search in.
	 * @param mixed $needle partial string to end with. If it is an array, it will test all.
	 * @return boolean True if ends with at least one correct entry.
	 */
	public static function endsWith($haystack, $needle) {
		$success = false;
		$haystack_length = strlen($haystack);
		if (is_string($needle)) {
			$needle_length = strlen($needle);
			if ($needle_length > $haystack_length)
				return false;
			return substr_compare($haystack, $needle, -$needle_length) === 0;
		} elseif (is_array($needle)) {
			foreach ($needle as $needle_single) {
				$needle_length = strlen($needle_single);
				if ($needle_length <= $haystack_length && substr_compare($haystack, $needle_single, -$needle_length) === 0)
					return true;
			}
		}
		return $success;
	}

}

?>
