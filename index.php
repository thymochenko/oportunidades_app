<?php include('protected/config/bootstrap.php');

$user=new authUsers();
$user->authStart();
$user->startSessionVerify();
$user->sessionClose();

function convert($size)
{
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}

$view = new ApplicationController();
$view->staticRender(array('view_dirname'=>'index','tpl_name'=>'index','extension'=>'tpl'));
 
//echo convert(memory_get_usage());

?>
