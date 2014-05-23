<?php /* Smarty version 2.6.21, created on 2010-10-28 03:54:04
         compiled from c:/www/aguia/protected/views/views.index/index.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
    <head>
    <meta http-equiv="Content-Type" content="text/html;
   charset=iso-8859-1"/>
    <base href="<?php  echo TURL::URLBASE; ?>/"/>
    <title>Aguia Serigrafia - seu site sobre serigrafia, balões e artigos de Serigrafia de Teresiana PI</title>
	<meta name="description" content="site da empresa Aguia Serigrafia, contendo seus produtos, balões, para festas, balões decorados" />
    <meta name="keywords" content="Balões, Balôes personalizados, serigrafia, teresina piauí serigrafia" />
    <meta name="author" content="Aguia Serigrafias" />
    <script type="text/javascript" language="javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/ajax.js"></script> 
	<script type="text/javascript" language="javascript" src="js/jquery.cycle.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/action.js"></script> 
    <link href="css/masterStyle.css" rel="stylesheet" type="text/css" media="all"/>
	<?php echo '
	<script type="text/javascript"> 
	$(function() {
	$(\'#slideShow\').cycle({ fx: \'fade\' });
	});
	</script> 
         <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-19014991-2\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

   </script>
	'; ?>

    </head>
    <body>
        <div id="corpo">
            <div id="corpo_conteudo">
            <div id="corpo_conteudo_topo"><h1 class="title_conteudo"></h1>
                    <div class="busca_conteudo"> 
                   <form id="form1" name="form1" method="get" action="index.php">
                   <label>busca:
                   <input name="seach" type="text"/>
                   <input type="submit" value="Buscar" />
           </label>
           </form>
           </div>
         </div>
<!--  menu principal -->
<div id="corpo_conteudo_menu">
<ul>
    <li class="span1">
	    <a href="posts/index.html">Home</a>
	</li>
    <li class="span1">
	    <a href="THYMO01.HTML">Quem somos</a>
	</li>
    <li class="span2">
	    <a href="main.php?class=images&method=paginate">Balões</a>
	</li>
    <li class="span2">    
	    <a href="posts/index.html">Notícias</a>
	</li>
    <li class="span2">
	    <a href="contact/insertContact.html">Fale conosco</a>
	</li>
    <li class="span2">
	    <a href="pages/index.html">Paginas</a>
	</li>
</ul>
</div>
<!--  close -->


<div id="corpo_conteudo_paginate_esquerda">

<?php index::initFrontController(); ?>
<?php index::viewRenderer('posts')->seachIndex(); ?>

<div id="corpo_conteudo_paginates_esquerda_ir_formulario">
</div>
</div>
<div id="corpo_conteudo_direita">
<div id="corpo_conteudo_direita_tag">
<h4 class="span1"><a href="category/index.html">
<img src="imgs/boxcategoy.png"/>
Categorias</a>
<img id="closecat"src="imgs/close.png"/>
<img id="opencat"src="imgs/open.png"/></h4>
<div class="linecat">
<?php index::viewRenderer('category')->indexList(); ?>
</div>
</div>

<div id="corpo_conteudo_direita_up">
<h2 class="span1"><a href="posts/index.html">
<img src="imgs/boxposts.png"/>
Notícias</a>

<img id="closeposts"src="imgs/close.png"/>
<img id="openposts"src="imgs/open.png"/>
</h2>
<div class="lineposts">
<?php index::viewRenderer('posts')->indexList(); ?>
</div>
</div>

<div id="corpo_conteudo_direita_uc">
<h2 class="span1">
<img src="imgs/boxcomm.png"/>
<span style="color:#666;">Comentários</span>
<img id="closecomm"src="imgs/close.png"/>
<img id="opencomm"src="imgs/open.png"/>
</h2>
<div class="linecomm">
<?php index::viewRenderer('comments')->indexList(); ?>
</div>
</div>

<div id="corpo_conteudo_direita_rss">
<h2><img src="imgs/boxrss.png"/>
<span style="color:#666;">RSS</span>
<img id="closerss"src="imgs/close.png"/>
<img id="openrss"src="imgs/open.png"/>
</h2>
<div class="linerss">
<ul>
<li><a href="main.php?class=posts&method=feed">
Rss dos posts</a></li>
<li><a href="main.php?class=comments&method=feed">Rss dos comentarios</a></li>
</ul>
</div>
</div>

<div id="corpo_conteudo_direita_link">
<h2><img src="imgs/boxlinks.png"/> <span style="color:#666;">Links</span>
<img id="closelinks"src="imgs/close.png"/>
<img id="openlinks"src="imgs/open.png"/>
</h2>
<div class="linelinks">
<?php index :: viewRenderer('links')->indexList(); ?>
</div>
</div>


<div id="corpo_conteudo_direita_pages">
<h2><a href="pages/index.html"><span style="color:#666;">Páginas</span></a></h2>
<div class="linha"></div>
<?php index::viewRenderer('pages')->indexList(); ?>
</div>
<!--containerClose()--></div>

</div>

<div id="corpo_rodape">
<b>Copyright @ THYMO - 2010.<br>
php, smarty, MVC, design patterns.</b>
</div>
</div>

</body></html>