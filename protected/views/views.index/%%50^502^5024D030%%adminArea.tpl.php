<?php /* Smarty version 2.6.21, created on 2010-12-19 02:13:36
         compiled from C:/Program+Files/wamp/www/aguia/protected/views/views.index/adminArea.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;
charset=iso-8859-1"/>
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico" />
		<link href="media/js/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
		<title>DataTables example</title>
		<style type="text/css" title="currentStyle">
		        @import "media/css/demos.css";
			    @import "media/css/demo_page.css";
			    @import "media/css/demo_table_jui.css";
			    @import "examples_support/themes/smoothness/jquery-ui-1.7.2.custom.css";
			    @import "media/css/adminStyle.css"
		</style>
<script type="text/javascript" src="media/js/shadowbox/shadowbox.js"></script> 
<link href="media/js/shadowbox/shadowbox.css" media="screen" rel="stylesheet" type="text/css"/> 
        <script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
	    <script type="text/javascript" language="javascript" src="media/js/loadLinks.js"></script> 
		<script> 
		<?php echo '
        $(document).ready(
            function()
			{
                $(".userPeril").click(function () {$(".efect").slideToggle();});
            });
  </script>

 <script type="text/javascript"> 
  Shadowbox.init();
  </script> 
		<script type="text/javascript" charset="charset=iso-8859-1">
			$(document).ready(function() {
				oTable = $(\'#example\').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers"
				});
			} );
		</script>
		<!--Data tables method  -->
  
		

<style>
ul 
{
display:inline;
}

</style>
'; ?>

	</head>
	<body id="dt_example">

<div class="jqmWindow" id="ex2">

</div>

		<div id="container">
			<div class="topo">
				          <ul class="welcome">
						  <li><a href="#">DOCUMENTAÇÃO</a></li>
						  <li><a href="#">DESENVOLVEDOR</a></li>
						  <li><a href="#">PARCELAS</a></li>
						  <li><a href="#">CONFIGURAÇÃO</a></li>
						  <li></li>
					</ul>
			</div>
			<div class="submenu">
			        <ul id="menu_principal">
			                <li><a class="posts"    href="?class=posts&method=All">posts</a></li>
			                <li><a class="category" href="?class=category&method=All">Categorias</a></li>
			                <li><a class="comments" href="?class=comments&method=All">Comentários</a></li>
			                <li><a class="links"    href="?class=links&method=All">links</a></li>
			                <li><a class="contact"  href="?class=contact&method=All">Contato</a></li>
			                <li><a class="users"    href="?class=users&method=All">Usuarios</a></li>
			                <li><a class="pages"    href="?class=pages&method=All">Páginas</a></li>
					        <li><a class="pages"    href="?class=images&method=All">galeria</a></li>
			    </ul>
			</div>
			<div id="loading"></div>
			<div id="mainTemplats">
            <?php admin :: initFrontController(); ?>
</div>