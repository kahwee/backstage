<?php

Yii::import('zii.widgets.grid.CDataColumn');

/**
 * KHtmlPurifierColumn represents a grid view column that renders purified html
 * in each of its data cells. It also does truncation when specified.
 * 
 * KHtmlPurifierColumn removes all malicious code (better known as XSS) with a 
 * thoroughly audited, secure yet permissive whitelist. It will also make sure 
 * the resulting code is standard-compliant.
 * 
 * It uses CHtmlPurifier which is wrapper of {@link http://htmlpurifier.org HTML Purifier}.
 * 
 * CHtmlPurifer is provided as part of Yii Framework.
 * 
 * KHtmlPurifierColumn accepts options from {@link http://htmlpurifier.org/live/configdoc/plain.html HTML Purifier}
 * 
 * Usage as part of column in CGridView:
 * <pre>
 * $this->widget('zii.widgets.grid.CGridView', array(
 *   'dataProvider' => $model->search(),
 *   'columns' => array(
 *     array(
 *       'class' => 'ext.kcolumns.KHtmlPurifierColumn',
 *       'name' => 'content',
 *       'options' => array(
 *         'HTML.AllowedElements' => array('i', 'em', 'strong', 'b', 'sup', 'sub'),
 *       ),
 *       'truncate_length' => 200, #Number of characters limit for truncation.
 *       'truncate_suffix' => '&hellip;', #Ellipses
 *     ),
 *     array(
 *       'name' => 'id',
 *     ),
 *   ),
 * ));
 * </pre>
 * 
 * In the above example, "HTML.AllowedElements" is one of the many configuration
 * options of {@link http://htmlpurifier.org/live/configdoc/plain.html HTML Purifier}
 *
 * @author KahWee Teng <t@kw.sg>
 * @version 1.0
 * @link http://kw.sg/
 * @copyright Copyright &copy; 2012 KahWee Teng
 * @license http://www.opensource.org/licenses/mit-license.php
 */
class KHtmlPurifierColumn extends CDataColumn {

	/**
	 * @var array Options for HTML Purifier.
	 */
	public $options = array();

	/**
	 * @var integer Length that will be shown before truncation occurs. Default
	 * to 0, this means no truncation will occur. Truncation length is in number
	 * of characters.
	 */
	public $truncate_length = 0;

	/**
	 * @var string Suffix of the truncated content.
	 */
	public $truncate_suffix = '&hellip;';

	/**
	 * @var array Default options for HTML Purifier. left empty.
	 */
	protected $defaultOptions = array('HTML.AllowedElements' => array(
		));

	/**
	 * Simple truncate function that considers HTML.
	 * 
	 * @link http://snippets.dzone.com/posts/show/7125
	 * @author Jonas Raoni Soares Silva
	 * @param string $text Content itself.
	 * @param integer $length By number of characters
	 * @param string $suffix Suffix, defaults to ellipses.
	 * @param boolean $isHTML 
	 * @return string Truncated text.
	 */
	public function truncate($text, $length, $suffix = '&hellip;', $isHTML = true) {
		if (strlen($text) <= $length)
			return $text;
		$i = 0;
		$simpleTags = array('br' => true, 'hr' => true, 'input' => true, 'image' => true, 'link' => true, 'meta' => true);
		$tags = array();
		if ($isHTML) {
			preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
			foreach ($m as $o) {
				if ($o[0][1] - $i >= $length)
					break;
				$t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
				// test if the tag is unpaired, then we mustn't save them
				if ($t[0] != '/' && (!isset($simpleTags[$t])))
					$tags[] = $t;
				elseif (end($tags) == substr($t, 1))
					array_pop($tags);
				$i += $o[1][1] - $o[0][1];
			}
		}

		// output without closing tags
		$output = substr($text, 0, $length = min(strlen($text), $length + $i));
		// closing tags
		$output2 = (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');

		// Find last space or HTML tag (solving problem with last space in HTML tag eg. <span class="new">)
		$pos_tmp = preg_split('/<.*>| /', $output, -1, PREG_SPLIT_OFFSET_CAPTURE);
		$pos_tmp = end($pos_tmp);
		$pos = (int) end($pos_tmp);
		// Append closing tags to output
		$output.=$output2;

		// Get everything until last space
		$one = substr($output, 0, $pos);
		// Get the rest
		$two = substr($output, $pos, (strlen($output) - $pos));
		// Extract all tags from the last bit
		preg_match_all('/<(.*?)>/s', $two, $tags);
		// Add suffix if needed
		if (strlen($text) > $length) {
			$one .= $suffix;
		}
		// Re-attach tags
		$output = $one . implode($tags[0]);

		//added to remove  unnecessary closure
		$output = str_replace('</!-->', '', $output);

		return $output;
	}

	/**
	 * CHtmlPurifier removes all malicious code (better known as XSS) with a
	 * thoroughly audited, secure yet permissive whitelist. It will also make sure
	 * the resulting code is standard-compliant.
	 *
	 * @param string $content Impurity
	 * @link http://htmlpurifier.org/live/configdoc/plain.html
	 * @return string The purified content
	 */
	public function purifyHtml($content) {
		$p = new CHtmlPurifier();
		$p->options = CMap::mergeArray($this->options, $this->defaultOptions);
		return $p->purify($content);
	}

	/**
	 * Renders the data cell content.
	 * This method evaluates {@link value} or {@link name} and renders the result.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data associated with the row
	 */
	protected function renderDataCellContent($row, $data) {
		if ($this->value !== null)
			$value = $this->evaluateExpression($this->value, array('data' => $data, 'row' => $row));
		else if ($this->name !== null)
			$value = CHtml::value($data, $this->name);
		if ($value === null) {
			echo $this->grid->nullDisplay;
		} elseif ($this->truncate_length > 0) {
			echo $this->truncate($this->purifyHtml($value), $this->truncate_length, $this->truncate_suffix);
		} else {
			echo $this->purifyHtml($value);
		}
	}

}
