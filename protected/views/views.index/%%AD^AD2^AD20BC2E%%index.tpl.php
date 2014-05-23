<?php /* Smarty version 2.6.21, created on 2011-01-18 17:52:02
         compiled from D:/NETSOFT-WEB/xampp/htdocs/netprocess_18_jan_version/netprocess/protected/views/views.index/index.tpl */ ?>
<?php  require_once("config.php"); ?>

<?php 
/******************************************************************
// MODULO ..........: Tela de login do sistema
// ARQUIVO .........: Login para acessar o sistema
// BY ..............: Marcelo Eugenio 
// EMAIL ...........: marcelo@galerashow.com.br 
// DATA ............: 16/09/2006
// DATA ALTERACAO...: 10/05/2007
/******************************************************************/

include "./nada.php"; // CONECTA AO BANCO DE DADOS
 ?>
<HTML>
<HEAD>

<!--pega o objeto contendo a informação da barra de título -->
<title><?php parametro::getValuesForParametro(); ?></title>
<!-- end -->

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<LINK HREF="css/estilo_padrao.css" REL="stylesheet" TYPE="text/css"/>
<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript" SRC="js/funcoes_padrao.js"></SCRIPT> 

<script src="components/tiny_mce/tiny_mce.js"></script>
</HEAD>
<?php echo '
<SCRIPT TYPE="text/javascript">

function setFocus()
{ document.getElementById("login").focus() }

</SCRIPT>
'; ?>
 
<BODY BGCOLOR="#BCD4F6" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" onLoad="setFocus()">
<TABLE WIDTH="326" HEIGHT="114" BORDER="0" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0">
 <TR> 
 <TD width="28%">&nbsp;</TD>
 <TD width="45%">&nbsp;</TD>
 <TD width="27%">&nbsp;</TD>
 </TR>
 <TR>
 <TD colspan="3">
 	<table border="0" cellpadding="0" cellspacing="0" id="imgEnviar" style="display:block">
 	 <tr> 
 <td style="text-align:center">
 <!-- retorna as mensagens randômicas para o admin -->
<?php mensagens::getRandMensagens(); ?>
<!-- end -->
 </td>
 </tr>
	 </table>
 		<table border="0" cellpadding="0" cellspacing="0" id="imgEnviando" style="display:none">
 <tr> 
 <td width="500">
				<div align="center" class="preto_negrito_12">
					<img src="img/carregando.gif">&nbsp;Aguarde carregando o sistema...
					<br><br>
				</div>
			 </td>
 </tr>
 </table>
	</TD>
 </TR>
 <TR> 
 <TD HEIGHT="116">&nbsp;</TD>
 <TD ALIGN="left" VALIGN="top">
						<TABLE WIDTH="326" HEIGHT="114" BORDER="0" ALIGN="CENTER" CELLPADDING="0" CELLSPACING="0">
								<TR> 
								<TD ALIGN="left" VALIGN="top"><IMG SRC="img/chaves.gif" WIDTH="326" HEIGHT="60"></TD>
								</TR>
								<TR> 
								<TD HEIGHT="24" ALIGN="left" VALIGN="top"> <TABLE WIDTH="326" BORDER="0" CELLPADDING="0" CELLSPACING="0">
									 <TR> 
										<TD WIDTH="3" HEIGHT="144" BACKGROUND="img/borda_lateral.gif"></TD>
										<TD WIDTH="321" BGCOLOR="#ecebe6">
										<TABLE WIDTH="308" HEIGHT="120" BORDER="0" ALIGN="center" CELLPADDING="0" CELLSPACING="0">
											<TR> 
											 <TD>&nbsp;</TD>
											 <TD><FORM NAME="form" METHOD="POST" ACTION="autenticar.php">
											 <?php 
											 if ($_GET["error"]==1){
											 echo "<div class=\"vermelho_negrito_12\" ALIGN=\"center\"><br>AUTENTICAÇÃO RECUSADA, Por favor digite o login e a senha!<BR><BR></div>
											 <SCRIPT TYPE=\"text/javascript\">
												 alert(\"AUTENTICAÇÃO RECUSADA, Por favor digite o login e a senha!\");												
											 </SCRIPT>";
											 }
											 if ($_GET["error"]==2){
											 echo "<div class=\"vermelho_negrito_12\" ALIGN=\"center\"><br>AUTENTICAÇÃO RECUSADA, Por favor verifique o login e a senha!<BR><BR></div>
											 <SCRIPT TYPE=\"text/javascript\">
												 alert(\"AUTENTICAÇÃO RECUSADA, Por favor verifique o login e a senha!\");												
											 </SCRIPT>";
											 }
											 
											 echo"<div id=\"aviso_caps_lock\" class=\"vermelho_negrito_12\" ALIGN=\"center\" style=\"visibility: hidden\">Atenção: O Caps Lock esta ativado!</div>";
											  ?>
												 <DIV ALIGN="center" CLASS="preto_negrito_10">Login<BR>
													<INPUT TYPE="text" NAME="login" ID="login" SIZE="25" VALUE="" onKeyPress="checar_caps_lock(event)" style="text-align: center; " />
													<BR>
													Senha<BR>
													<INPUT TYPE="password" NAME="senha" SIZE="25" VALUE="" onKeyPress="checar_caps_lock(event)" style="text-align: center; " />
													<BR>
													<BR>
													<INPUT NAME="submit" TYPE="submit" STYLE="background-color: #CCCCCC; color: #000000; border-style: solid; border-color: #BCD4F6" VALUE="Entrar" onClick="imageEnviando();">
													<INPUT NAME="reset" TYPE="reset" STYLE="background-color: #CCCCCC; color: #000000; border-style: solid; border-color: #BCD4F6" VALUE="Limpar">
												 </DIV>
												</FORM></TD>
											 <TD>&nbsp;</TD>
											</TR>
										 </TABLE>
										 </TD>
										<TD WIDTH="3" BACKGROUND="img/borda_lateral.gif"> </TD>
									 </TR>
									 <TR ALIGN="left" VALIGN="top"> 
										<TD HEIGHT="5" COLSPAN="3"><IMG SRC="img/borda_baixo.gif" WIDTH="326" HEIGHT="5"></TD>
									 </TR>
									</TABLE></TD>
								</TR>
							 </TABLE>
	</TD>
 <TD>&nbsp;</TD>
 </TR>
 <TR> 
 <TD>&nbsp;</TD>
 <TD align="center"><span CLASS="preto_10">Versão 2.0<br><br></span></TD>
 <TD>&nbsp;</TD>
 </TR>
 <TR>
 <TD>&nbsp;</TD>
 <TD align="center"><span CLASS="preto_12">* Seu navegador deve aceitar "cookies" para acessar este serviço.</span></TD>
 <TD>&nbsp;</TD>
 </TR>
</TABLE>
</BODY>
</HTML>