<?php
abstract class AppBehaviorFilter{
    public function verifyPermission(){
        $user = new authUsers();
		$user->authStart();
		$user->startSessionVerify();    
    }
}
?>
