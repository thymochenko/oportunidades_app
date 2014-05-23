<?php /* Smarty version Smarty-3.1.8, created on 2012-06-01 00:34:03
         compiled from "/var/www/naruto_g/protected/views/views.index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2759103484fc8382b5b6879-03234568%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee61497753ac22f44372144987802f19eeca0865' => 
    array (
      0 => '/var/www/naruto_g/protected/views/views.index/index.tpl',
      1 => 1338521640,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2759103484fc8382b5b6879-03234568',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fc8382b618f35_42418696',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fc8382b618f35_42418696')) {function content_4fc8382b618f35_42418696($_smarty_tpl) {?><html>
    <head>
        <<?php ?>?php Partial::init()->module('ApplicationController')->message('css');?<?php ?>>
        <<?php ?>?php Partial::init()->module('ApplicationController')->message('javascripts');?<?php ?>>
        <<?php ?>?php Partial::init()->module('ApplicationController')->message('colorBoxSettings');?<?php ?>>
    </head>
    <<?php ?>?php Partial::init()->module('ApplicationController')->message('menu');?<?php ?>>
    <body>
	<<?php ?>?php 
        $frontController=LzAutoLoad::getFrontController();
        $frontController->listering();
        $frontController->run();
	?<?php ?>>
	</body>
</html> <?php }} ?>