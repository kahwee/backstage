<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	
	
	private $_pageCaption = null;
	private $_pageDescription = null;

	/**
	 * @return string the page heading (or caption). Defaults to the controller name and the action name,
	 * without the application name.
	 */
	public function getPageCaption() {
	    if($this->_pageCaption!==null)
	        return $this->_pageCaption;
	    else
	    {
	        $name=ucfirst(basename($this->getId()));
	        if($this->getAction()!==null && strcasecmp($this->getAction()->getId(),$this->defaultAction))
	            return $this->_pageCaption=$name.' '.ucfirst($this->getAction()->getId());
	        else
	            return $this->_pageCaption=$name;
	    }
	}

	/**
	 * @param string $value the page heading (or caption)
	 */
	public function setPageCaption($value) {
	    $this->_pageCaption = $value;
	}

	/**
	 * @return string the page description (or subtitle). Defaults to the page title + 'page' suffix.
	 */
	public function getPageDescription() {
	    if($this->_pageDescription!==null)
	        return $this->_pageDescription;
	    else
	    {
	        return Yii::app()->name . ' ' . $this->getPageCaption() . ' page';
	    }
	}

	/**
	 * @param string $value the page description (or subtitle)
	 */
	public function setPageDescription($value) {
	    $this->_pageDescription = $value;
	}

}