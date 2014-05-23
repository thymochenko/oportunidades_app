<?php
#error_reporting(0);
include_once($_SERVER['DOCUMENT_ROOT'] . '/oportunidades_core/core/kernel/metadata_class/_AutoLoad.class.php');

new ConfigDatabase(array
(
	'config_database'=>array(
	'database'=>'bd_oportunidades'
)));


ConfigSmarty::_setConfig(array(
    'smarty_config'=>array(
    'smarty_compiler_mod'=>true)
));

ConfigPHPUnitest::_setConfig(array(
	'phpunit_test_config'=>array('load'=>false)
));

ConfigPath::_setConfig(array(
        'conf_path'=>array(
        'http_path_app_base'=>'http://' . $_SERVER['HTTP_HOST'] . '/oportunidades_app',
	    'app_core'=>$_SERVER['DOCUMENT_ROOT'] . '/oportunidades_core/core',
	    'path_app_base'=>$_SERVER['DOCUMENT_ROOT'] . '/oportunidades_app',
	    'login_admin_redirect_default'=>'http://'. $_SERVER['HTTP_HOST'] .'/oportunidades/page.php?class=usuarios&method=autenticacaoFilter',
	    'path_base_for_admin'=>'',
            'http_path_logout'=>'http://'. $_SERVER['HTTP_HOST'] .'/oportunidades/index.php'
)));

new ConfigTemplate(array(
    'global_conf_template'=>array(
    'default_template'=>'SimpleTemplateComponent'))
);

ConfigMail::_setConfig(array(
    'host'=>null,
    'username'=>null,
    'password'=>null,
    'addaddress'=>null)
);

ConfigDebug::_setConfig(array(
	'global_objects'=>array(
	'mod_debug'=>false))
);

ConfigLogger::_setConfig(array(
    'log'=>array('start_log'=>false,
	'path_html'=>'/var/www/naruto_g/protected/logs/logs_html/',
	'path_xml'=>'/var/www/naruto_g/protected/logs/logs_xml/',
	'path_txt'=>'/var/www/naruto_g/protected/logs/logs_txt/'
)));