<?php /* Smarty version 2.6.21, created on 2013-05-25 16:50:51
         compiled from c:/wamp/www/naruto_g/protected/views/views.index/index.tpl */ ?>
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