<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * The base class for any class that defines a view.
 * A view controls how templates are loaded as well as
 * being the final point where data manipulation can occur.
 *
 * @package    Eden
 */
abstract class Front_Page extends Eden_Class {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_meta	= array();
	protected $_head 	= array();
	protected $_body 	= array();
	protected $_foot 	= array();

	protected $_title 		= NULL;
	protected $_class 		= NULL;
	protected $_template 	= NULL;
	// protected $_db 	= NULL;

	/* Private Properties
	-------------------------------*/
	/* Get
	-------------------------------*/
	/* Magic
	-------------------------------*/


	public function __toString() {
		try {
			$output = $this->render();
		} catch(Exception $e) {
			Eden_Error_Event::i()->exceptionHandler($e);
			return '';
		}

		if(is_null($output)) {
			return '';
		}

		return $output;
	}

	protected function _amazonSearch($keyword, $page=1,$all = false) {
		//Set amazon ecs web services
		$response = Eden_Amazon_Ecs::i(self::AMAZON_PRIVATE_KEY, self::AMAZON_PUBLIC_KEY)
			//set service to `AWSECommerceService`
			->setService(self::AMAZON_SERVICE)
			->setTimestamp()
			//set version to `2009-03-31`
			->setVersion(self::AMAZON_VERSION)
			//operation is ItemSearch
			->setOperation('ItemSearch')
			//set keyword
			->setKeyword($keyword)
			->setSearchIndex()
			//set response group to large
			->setResponseGroup('Large')
			//country default is us
			->setCountry()
			->setIdType('EAN')
			//associate tag is the affilate tag (ID)
			->setAssociateTag(self::AMAZON_TAG)
			//set page
			->setPage($page)
			//get response which is xml format
			->getResponse();
		//convert response from xml to object
		$pxml = simplexml_load_string($response);

		if($all) {
			return $pxml;
		}

		if(is_object($pxml) && isset($pxml->Items)) {
			$return = $pxml->Items;
		} else {
			$return = NULL;
		}

		return $return;

	}

	/* Public Methods
	-------------------------------*/
	/**
	 * Returns a string rendered version of the output
	 *
	 * @return string
	 */
	abstract public function render();

	/* Protected Methods
	-------------------------------*/
	protected function _page() {

		$this->_head['page'] = $this->_class;

		$page = front()->path('page').'/../template';
		$head = front()->trigger('head')->template($page.'/_head.phtml', $this->_head);
		$body = front()->trigger('body')->template($page.$this->_template, $this->_body);
		$foot = front()->trigger('foot')->template($page.'/_foot.phtml', $this->_foot);

		//page
		return front()->template($page.'/_page.phtml', array(
			'meta' 			=> $this->_meta,
			'title'			=> $this->_title,
			'class'			=> $this->_class,
			'head'			=> $head,
			'body'			=> $body,
			'foot'			=> $foot));
	}

	/* Private Methods
	-------------------------------*/
}