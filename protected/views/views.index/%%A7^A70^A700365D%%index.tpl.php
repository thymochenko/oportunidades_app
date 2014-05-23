<?php /* Smarty version 2.6.21, created on 2013-08-25 03:07:19
         compiled from C:/wamp/www/naruto_g/protected/views/views.index/index.tpl */ ?>
<html>
    <head>
        <?php Partial::init()->module('ApplicationController')->message('css'); ?>
        <?php Partial::init()->module('ApplicationController')->message('javascripts'); ?>
        <?php Partial::init()->module('ApplicationController')->message('colorBoxSettings'); ?>
    </head>
    <?php Partial::init()->module('ApplicationController')->message('menu'); ?>
    <body>
	<?php 
        $frontController=_AutoLoad::getFrontController();
        $frontController->listering();
        $frontController->run();
	 ?>
	</body>
</html> 