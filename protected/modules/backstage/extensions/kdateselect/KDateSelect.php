<?php

/**
 * KDateSelect generates a select box for dates and time.
 *
 * @author KahWee Teng <t@kw.sg>
 * @version 1.0
 * @link http://kw.sg/
 * @copyright Copyright &copy; 2012 KahWee Teng
 * @license http://www.opensource.org/licenses/mit-license.php
 */
class KDateSelect extends CInputWidget {
	const ORDER_ASC = true;
	const ORDER_DESC = false;
	const DEFAULT_START_DATE = '-5 years';
	const DEFAULT_END_DATE = '+5 years';
	const FORMAT_MONTH_SHORT = 'M';
	const FORMAT_MONTH_FULL = 'F';
	const FORMAT_MONTH_SHORT_W_NUMBER = 'm - M';
	const FORMAT_MONTH_FULL_W_NUMBER = 'm - F';


	/**
	 * @var string the template to be used to control the layout of in the view.
	 * These tokens are recognized: {year}, {month} and {day}. They will be replaced with the
	 * year, month, day select boxes.
	 */
	public $template = "{year} {month} {day} {hour}:{minute}:{second}";

	/**
	 * @var string Start date time. Needs to be in format of PHP's strtotime
	 * @link http://php.net/manual/en/function.strtotime.php
	 */
	public $startDate = self::DEFAULT_START_DATE;

	/**
	 * @var string End date time. Needs to be in format of PHP's strtotime
	 * @link http://php.net/manual/en/function.strtotime.php
	 */
	public $endDate = self::DEFAULT_END_DATE;

	/**
	 * @var string Format of the month, use a combination of F, m, M, n, and t.
	 * @link http://php.net/manual/en/function.date.php
	 */
	public $monthFormat = self::FORMAT_MONTH_FULL;
	public $reverseYears = false;
	public $reverseMonths = false;
	public $reverseDays = false;
	public $reverse = null;

	/**
	 * Start of the date time for the select box.
	 *
	 * @var DateTime Representation of date and time..
	 */
	private $startDateTime = null;

	/**
	 * Start of the date time for the select box.
	 *
	 * @var DateTime Representation of date and time..
	 */
	private $endDateTime = null;

	/**
	 *
	 * @var DateInterval Representation of date interval.
	 */
	private $interval = null;

	/**
	 * Gets the year options for a select box.
	 *
	 * @return array Options for select box.
	 */
	public function yearOptions() {
		$years = range($this->startDateTime->format('Y'), $this->endDateTime->format('Y'));
		if ($this->reverseYears)
			$years = array_reverse($years);
		$yearOptions = array();
		foreach ($years as $year) {
			$yearOptions[$year] = $year;
		}
		return $yearOptions;
	}

	/**
	 * Gets the year options for a select box.
	 *
	 * @return array Options for select box.
	 */
	public function dayOptions() {
		$days = range(1, 31);
		if ($this->reverseDays)
			$days = array_reverse($days);
		$dayOptions = array();
		foreach ($days as $day) {
			$day = str_pad($day, 2, "0", STR_PAD_LEFT);
			$dayOptions[$day] = $day;
		}
		return $dayOptions;
	}

	/**
	 * Gets the month options for a select box.
	 *
	 * @param string $format use constants such as FORMAT_MONTH_SHORT_W_NUMBER.
	 * @return array Options for select box.
	 */
	public function monthOptions($format=self::FORMAT_MONTH_FULL) {
		$months = range(0, 11);
		if ($this->reverseMonths)
			$months = array_reverse($months);
		$monthOptions = array();
		foreach ($months as $month) {
			$tmp_date = mktime(0, 0, 0, $month + 1);
			$monthOptions[$month] = date($format, $tmp_date);
		}
		return $monthOptions;
	}

	/**
	 * Executes the widget.
	 * This method registers all needed client scripts and renders
	 * the text area.
	 */
	public function run() {
		#Attempt to fix start and end date times first.
		$this->startDateTime = new DateTime($this->startDate);
		$this->endDateTime = new DateTime($this->endDate);
		$this->interval = $this->startDateTime->diff($this->endDateTime);
		if ($this->interval->invert === 1) {
			throw new CException(__CLASS__ . '\'s startDate is after endDate.');
		}
		#reseting the various reverses
		if (!is_null($this->reverse)) {
			$this->reverseYears = $this->reverseMonths = $this->reverseDays = $this->reverse;
		}

		list($this->name, $id) = $this->resolveNameID();
		if (isset($this->htmlOptions['id']))
			$id = $this->htmlOptions['id'];
		else
			$this->htmlOptions['id'] = $id;
		if (isset($this->htmlOptions['name']))
			$this->name = $this->htmlOptions['name'];

		$this->registerClientScript();
		if ($this->hasModel())
			echo CHtml::activeHiddenField($this->model, $this->attribute, $this->htmlOptions);
		else
			echo CHtml::hiddenField($this->name, $this->value, $this->htmlOptions);
		echo preg_replace_callback("/{(\w+)}/", array($this, 'renderSection'), $this->template);
	}

	/**
	 * This renders a select element for every placeholder found in {@link template}.
	 * It should return the rendering result that would replace the placeholder.
	 *
	 * @param array $matches the matches, where $matches[0] represents the whole placeholder,
	 * while $matches[1] contains the name of the matched placeholder.
	 * @return string the rendering result of the section
	 */
	protected function renderSection($matches) {
		$name = __CLASS__ . $this->name;
		switch ($matches[1]) {
			case 'year':
				return CHtml::dropDownList($name . '[year]', '', $this->yearOptions());
				break;
			case 'month':
				return CHtml::dropDownList($name . '[month]', '', $this->monthOptions());
				break;
			case 'day':
				return CHtml::dropDownList($name . '[day]', '', $this->dayOptions());
				break;
			case 'hour':
				return CHtml::textField($name . '[hour]');
				break;
			case 'minute':
				return CHtml::textField($name . '[minute]');
				break;
			case 'second':
				return CHtml::textField($name . '[second]');
				break;
		}
		return $matches[0];
	}

	/**
	 * Registers the needed CSS and JavaScript.
	 */
	public function registerClientScript() {
		$cs = Yii::app()->getClientScript();
		$cs->registerCoreScript('jquery');
		$id = $this->htmlOptions['id'];
		$kdateselect_id = __CLASS__ . $id;
		$js = <<<JAVASCRIPT
jQuery(function($) {
	$(document).ready(function() {
		var datetime = new Date($('#{$id}').val());
		$('#{$kdateselect_id}_year').val(datetime.getFullYear());
		$('#{$kdateselect_id}_month').val(datetime.getMonth());
		$('#{$kdateselect_id}_day').val(datetime.getDay());
		$('#{$kdateselect_id}_hour').val(datetime.getHours());
		$('#{$kdateselect_id}_minute').val(datetime.getMinutes());
		$('#{$kdateselect_id}_second').val(datetime.getSeconds());
	});

	$('#{$id}').parents('form').on('submit', function(ev) {
		var year = parseInt($('#{$kdateselect_id}_year').val());
		var month = parseInt($('#{$kdateselect_id}_month').val());
		var day = parseInt($('#{$kdateselect_id}_day').val());
		var hour = parseInt($('#{$kdateselect_id}_hour').val());
		var minute = parseInt($('#{$kdateselect_id}_minute').val());
		var second = parseInt($('#{$kdateselect_id}_second').val());
		var datetime = new Date(year, month, day, hour, minute, second);
		datetime.setUTCSeconds(datetime.getTimezoneOffset() * -1 * 60);
		$('#{$id}').val(datetime.toISOString());
		return true;
	});
})
JAVASCRIPT;
		$cs->registerScript('KahWee.KDateSelect#' . $id, $js);
	}

}
