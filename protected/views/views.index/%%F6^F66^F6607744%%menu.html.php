<?php /* Smarty version 2.6.21, created on 2013-08-17 04:03:08
         compiled from C:/wamp/www/naruto_g/protected/views/views.index/menu.html */ ?>
<div id="boxInitical"><h1> <span class="titulo">Herois Book</span> </h1>
            <div id="posixBox"><div id="menu">  
			<a href="?class=ninja&method=index">ninja</a>
			/   <a href="?class=categoria&method=index">categoria</a>
			<a href="?class=pais&method=index">/  pais</a>  /  grupos   / <a href="?class=cla&method=index">cla</a>  / combates / <a href="?class=elemento&method=index">elemento</a>/   missoes /  <a href="?class=organizacao&method=index">organização</a>
			/ <a href="?doLogout=true">Sair</a>
			</div>
                <form name="send" action="index.php?class=ninja&method=ataques" method="POST">
                    <input type="text" name="nome_ninja" value="" />
                    <input type="submit" value="enviar" name="" />
                    <input type="hidden" name="ataques" value="ninja">
                </form>
            </div>
        </div>