<?php

$frontController =_AutoLoad::getFrontController();
$frontController->run();

$user = new authUsers();
$user->authStart();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<link href="../css/admin.css" media="screen" rel="stylesheet" type="text/css"/>
<title>Formul&aacute;rio de login</title> 
</head> 

<body> 
<div id="corpo">
<div id="corpo_conteudo">
<?php if (isset ($_GET ['erro']) ): ?> 
<p> O login ou senha informados não conferem</p>
<?php endif; ?>
<form id="form1" method="POST" action="<?php echo authUsers::$loginFormAction; ?>"> 
        <p>Login:  
                <input name="login" type="text" id="login" size="a" /> 
        </p> 
        <p>Senha:  
                <input name="senha" type="password" id="senha" /> 
        </p> 
        <p> 
                <input type="submit" name="Submit" value="Login" /> 
        </p> 
</form> 
</div>
</div>
</body> 
</html> 