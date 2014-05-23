<?php
class ApplicationController extends ControllerFactory
{
	/**
	*@Aspect
	*/
	public $filter = array
	(
        'afterFilter' => array(
		'joinPoints' => null,'self' => array('deleteview','showDeleteInterface'),
        'adviceMethods' => array('verifyPermission'))
	);
		
	function menu()
	{ 
	    $this->staticRender(array(
	        'view_dirname'=>'index',
		    'tpl_name'=>'menu',
		    'extension'=>'html')
		);
	}
	
	

	public function css(){
	    
        echo '<link rel="stylesheet" href="http://localhost/naruto_g/colorbox/example3/colorbox.css" />' .
        '<link rel="stylesheet" href="http://localhost/naruto_g/css/style.css" />';
	}
	
	public function javascripts(){
	    echo ' <script src="http://localhost/naruto_g/colorbox/colorbox/jquery.min.js"></script>
        <script src="http://localhost/naruto_g/colorbox/colorbox/jquery.colorbox.js"></script>
		 <script src="http://localhost/naruto_g/ajax.js"></script>';
	}
	
	public function colorBoxSettings(){
	    echo '<script>
            $(document).ready(function(){
                $(".ajax").colorbox({width:"50%", height:"100%"});
                $(".ajax_edit").colorbox({width:"50%", height:"40%"});
				$(".ajax_small").colorbox({width:"50%", height:"40%"});
                $(".ajaxAdicionarAtaquesEvent").colorbox();
            });
        </script>';
	}
}
?>
