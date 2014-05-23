<?php
include_once('../../../protected/autoLoader.class.php');
autoLoader::getFrontController();
autoLoader::initializeTest();

class TestProdutoRecord extends UnitTestCase 
{
    /*
	*testOfStore()
	*testa se a persistъncia retorna diferente de null
	*e garante a relaчуo entre O usuario e seu Endereco
	*/
    public function testOfStore()
	{
	    try{
	        TTransaction::open();
			
		    $post = TActionController::post('stdClass');
			
			$produto=new produtoRecord;
			
		    $post->nome = 'Notebook' ;
		    $post->descricao = 'Prata';
		    $post->valor = 33002.2;
		    $post->foto = 'foto.jpg';
		    $post->foto_miniatura = 'miniatura_foto.jpg';
		    $post->desconto = 10.4;
		    $post->quantidade = 2;
		    $post->id_categoria = 1;
		    $post->id_loja = 1;
		    $post->modify = date('y-m-j');
		    $post->created = date('y-m-j');
		    $post->permint = 1;
			
		    $produto->nome = $post->nome;
		    $produto->descricao = $post->descricao;
		    $produto->valor = $post->valor;
		
    		//new ImageHelper('foto',array('width'=> 300, 'height'=> 300, 'auto'=> 470,'quality'=> 75,'square'=> 300));
		
	    	$produto->foto = $post->foto;
		    $produto->foto_miniatura = $post->foto_miniatura;
		
    		$produto->desconto = $post->desconto;
			$produto->quantidade = $post->quantidade;
		
		    $produto->id_categoria = $post->id_categoria;
			$produto->id_loja = $post->id_loja;	
			//store Procedure
			$produto->modify = date('y-m-j');
			$produto->created = date('y-m-j');
			$produto->permint = 0;

	        
			$this->assertNotNull($produto->store());
			
			$criterio=new TCriteria;
			$criterio->add(new TFilter('nome','=','Notebook'));
			$criterio->add(new TFilter('descricao','=','Prata'));
			$criterio->add(new TFilter('valor','=', 33002.2));
			$criterio->add(new TFilter('foto','=','foto.jpg'));
			$criterio->add(new TFilter('desconto','=',10.4));
			$criterio->add(new TFilter('quantidade','=',2));
			$criterio->add(new TFilter('id_categoria','=',1));
			$criterio->add(new TFilter('id_loja','=',1));
			
			$produtos=$produto->load(null,$criterio);
		    //passa se o nome do produto for igual ao parametro passado
			$this->assertEqual($produtos[0]->nome, 'Notebook');
			//descricao
			$this->assertEqual($produtos[0]->descricao, 'Prata');
			//valor
			$this->assertEqual($produtos[0]->valor, 33002.2);
			//foto
			$this->assertEqual($produtos[0]->foto, 'foto.jpg');
			//desconto
			$this->assertEqual($produtos[0]->desconto, 10.4);
			//quantidade
			$this->assertEqual($produtos[0]->quantidade, 2);
			//id_categoria
			$this->assertEqual($produtos[0]->id_categoria, 1);
			//id_loja
			$this->assertEqual($produtos[0]->id_loja, 1);
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfUpdate()
	{
	    try{
	        TTransaction::open();
			
		    $post = TActionController::post('stdClass');
			
			$produto=new produtoRecord;
			$post->id = 1;
		    $post->nome = 'NetBook' ;
		    $post->descricao = 'Azul';
		    $post->valor = 22002.2;
		    $post->foto = 'foto.jpg';
		    $post->foto_miniatura = 'miniatura_foto.jpg';
		    $post->desconto = 10.4;
		    $post->quantidade = 2;
		    $post->id_categoria = 1;
		    $post->id_loja = 1;
		    $post->modify = date('y-m-j');
		    $post->created = date('y-m-j');
		    $post->permint = 1;
            
            $produto->id = $post->id;			
		    $produto->nome = $post->nome;
		    $produto->descricao = $post->descricao;
		    $produto->valor = $post->valor;
		
    		//new ImageHelper('foto',array('width'=> 300, 'height'=> 300, 'auto'=> 470,'quality'=> 75,'square'=> 300));
		
	    	$produto->foto = $post->foto;
		    $produto->foto_miniatura = $post->foto_miniatura;
		
    		$produto->desconto = $post->desconto;
			$produto->quantidade = $post->quantidade;
		
		    $produto->id_categoria = $post->id_categoria;
			$produto->id_loja = $post->id_loja;	
			//store Procedure
			$produto->modify = date('y-m-j');
			$produto->created = date('y-m-j');
			$produto->permint = 1;

			$this->assertNotNull($produto->update());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfDestroy()
	{
	    TTransaction::open();
		
	    $produto=new produtoRecord;
		$produto->id = 2;
		$produto->permint = 0;
		$this->assertNotNull($produto->update());
		
		TTransaction::close();
	}
	
	
	public function testOfFindAll()
	{
	    TTransaction::open();
		
	    $produto=new produtoRecord;
		$colecao=$produto->findAll(array('limit'=>1000,'order'=>'id'));
		$this->assertNotNull($colecao);
		
		TTransaction::close();
	}
}
?>