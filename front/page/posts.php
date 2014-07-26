<?php
/**
* 
*/

class Front_Page_Posts extends Front_Page {
	
	protected $_class = '';
	protected $_template = '/../template/posts.php';
	protected $_title = 'Articles';
	protected $_db = null;

	public function render() {

		$this->_meta= array(
			'charset'		=> 'utf-8',
			'viewport'		=> 'width=device-width, initial-scale=1',);		

		$this->_body = array(
			'posts'		=> $this->getPosts());

		
		return $this->_page();
	}

	public function getPosts() {
		
		$posts = front()->database()->search()
			->setTable('post')
			->setColumns('*')
			//->filterByProductActive(0)
			// ->inspect()
			->getRows();

		
		// front()->output($posts);

		return $posts;
	}


}
?>