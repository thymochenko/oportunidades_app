<?php include_once('protected/autoLoader.class.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">

    <head>

        <meta http-equiv="Content-Type" content="text/html;
              charset=iso-8859-1"/>
        <base href="<?php echo TURL::URLBASE; ?>/"/>
        <title>O NOVO BLOG DE PLUGINS = 02</title>
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery.cycle.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/ajax.js"></script> 
        <script type="text/javascript" language="javascript" src="js/action.js"></script> 
        <link href="css/masterStyle.css" rel="stylesheet" type="text/css" media="all"/>
        <script type="text/javascript">
            <!--
               $(function() {
                $('#slideShow').cycle({fx: 'fade'});
            });
            // -->
        </script> 
    </head>

    <body>
        <div id="corpo">
            <div id="corpo_conteudo">
                <div id="corpo_conteudo_topo"><h1 class="title_conteudo"></h1>
                    <div class="busca_conteudo"> 
                        <form id="form1" name="form1" method="get" action="index.php">
                            <label>busca:
                                <input name="seach" type="text">
                                    <input type="submit" Value="Buscar" />
                            </label>
                        </form>
                    </div>
                </div>

                <div id="corpo_conteudo_menu">
                    <ul><b>
                            <li class="span1"><a href="THYMO01.HTML">Quem somos</a></li>
                            <li class="span2"><a href="main.php?class=images&method=show">Balões</a></li>
                            <li class="span2"><a href="posts/index.html">Posts</a></li>
                            <li class="span2"><a href="category/index.html">Categorias</a></li>
                            <li class="span2"><a href="contact/insertContact.html">Contato</a></li>
                            <li class="span2"><a href="pages/index.html">Paginas</a></li>
                        </b></ul>
                </div>
                <!--captura o evento get, cria um objeto controlador e envia o fluxo de dados do model -->
                <div id="corpo_conteudo_paginate_esquerda">
                    <?php indexController::viewRenderer('images')->simpleSlideImages(); ?>
                    <?php autoLoader::getFrontController(); ?>
                    <!--busca -->
                    <?php indexController::viewRenderer('posts')->seachIndex(); ?>
                    <!--[/busca]-->
                    <div id="corpo_conteudo_paginate_esquerda_ir_formulario">
                    </div>
                </div>
                <div id="corpo_conteudo_direita">
                    <div id="corpo_conteudo_direita_tag">
                        <h2 class="span1"><a href="category/index.html">
                                <img src="imgs/boxcategoy.png"/>
                                Categorias</a>
                            <img id="closecat"src="imgs/close.png"/>
                            <img id="opencat"src="imgs/open.png"/></h2>
                        <div class="linecat">
                            <?php indexController::viewRenderer('category')->indexList(); ?>
                        </div>
                    </div>

                    <div id="corpo_conteudo_direita_up">
                        <h2 class="span1"><a href="posts/index.html">
                                <img src="imgs/boxposts.png"/>
                                Postagens</a>

                            <img id="closeposts"src="imgs/close.png"/>
                            <img id="openposts"src="imgs/open.png"/>
                        </h2>
                        <div class="lineposts">
                            <?php indexController::viewRenderer('posts')->indexList(); ?>
                        </div>
                    </div>

                    <div id="corpo_conteudo_direita_uc">
                        <h2 class="span1">
                            <img src="imgs/boxcomm.png"/>
                            Comentários
                            <img id="closecomm"src="imgs/close.png"/>
                            <img id="opencomm"src="imgs/open.png"/>
                        </h2>
                        <div class="linecomm">
                            <?php indexController::viewRenderer('comments')->indexList(); ?>
                        </div>
                    </div>

                    <div id="corpo_conteudo_direita_rss">
                        <h2 class="span1"><img src="imgs/boxrss.png"/>RSS
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
                        <h2 class="span1"><img src="imgs/boxlinks.png"/> links
                            <img id="closelinks"src="imgs/close.png"/>
                            <img id="openlinks"src="imgs/open.png"/>
                        </h2>
                        <div class="linelinks">
                            <?php indexController::viewRenderer('links')->indexList(); ?>
                        </div>
                    </div>


                    <div id="corpo_conteudo_direita_pages">
                        <h2 class="span1"><a href="pages/index.html">Paginas</a></h2>
                        <div class="linha"></div>
                        <?php indexController::viewRenderer('pages')->indexList(); ?>
                    </div>
                    <!--containerClose()--></div>

            </div>

            <div id="corpo_rodape">
                <b>Copyright @ THYMO - 2010.<br>
                        php, smarty, MVC, design patterns.</b>
            </div>
        </div>

    </body></html>