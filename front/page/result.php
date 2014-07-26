<?php //-->
/*
 * This file is part a custom application package.
 */

/**
 * Default logic to output a page
 */
class Front_Page_Result extends Front_Page {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_title = 'iWantBut';
	protected $_class = 'home';
	protected $_template = '/result.phtml';

	/* Private Properties
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	public function render() {
	// set keywords
	$iLike = $_POST['iLike'];
	$iWant = $_POST['iWant'];

	// return the values to the output page
	$this->_body = array(
            'javascriptiWant' => $this->_parseImage($iWant, $iLike)
     );
		return $this->_page();
	}

	protected function _parseImage($iWant, $iLike) {

	$googleImageScript = 'google.load("search", "1");

      function searchCompleteiWant(searcher) {
        if (searcher.results && searcher.results.length > 0) {

          var contentDiv = document.getElementById("iWant");
          var results = searcher.results[0];
          var result = results;
          var imgContainer = document.getElementById("content");

          var title =  document.getElementById("iWant-h2");
          title.innerHTML = result.titleNoFormatting;

          // var newImg = document.getElementById("iWant-img");
          // newImg.src = result.tbUrl;

          imgContainer.appendChild(title);

	        for(var i = 0; i < 6;i++) {
	          var results = searcher.results[i];
	          var result = results;
		          var img2 =  document.createElement("img");
		          img2.id = "iWant-" + i;
	          img2.src = result.tbUrl;

		          imgContainer.appendChild(img2);
	        }

          contentDiv.appendChild(imgContainer);

        }
      }

      function searchCompleteiLike(searcher) {
        if (searcher.results && searcher.results.length > 0) {

          var contentDiv = document.getElementById("iLike");
          var results = searcher.results[0];
          var result = results;
          var imgContainer = document.getElementById("content");

	      var title =  document.getElementById("iLike-h2");
          title.innerHTML = result.titleNoFormatting;

          // var newImg = document.getElementById("iLike-img");
          // newImg.src = result.tbUrl;

          imgContainer.appendChild(title);
          // imgContainer.appendChild(newImg);

	      for(var i = 0; i < 6;i++) {
	          var results = searcher.results[i];
	          var result = results;
	          var img2 =  document.createElement("img");
	          img2.id = "iLike-" + i;
	          img2.src = result.tbUrl;

	          imgContainer.appendChild(img2);
	      }

          contentDiv.appendChild(imgContainer);

        }
      }

	    function OnLoad() {
	      var imageSearch = new google.search.ImageSearch();

	     // imageSearch.setRestriction(google.search.ImageSearch.RESTRICT_IMAGESIZE,
	     //                          google.search.ImageSearch.IMAGESIZE_LARGE);

	      imageSearch.setSearchCompleteCallback(this, searchCompleteiLike, [imageSearch]);
	      imageSearch.execute("'.$iWant.'");

	      var imageSearchLike = new google.search.ImageSearch();
		  // imageSearchLike.setRestriction(google.search.ImageSearch.RESTRICT_IMAGESIZE,
	      // google.search.ImageSearch.IMAGESIZE_LARGE);

	      imageSearchLike.setSearchCompleteCallback(this, searchCompleteiWant, [imageSearchLike]);
	      imageSearchLike.execute("'.$iLike.'");

	    }

	    google.setOnLoadCallback(OnLoad);';

	    return $googleImageScript;
	}

	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}
