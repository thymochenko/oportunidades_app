<?php
include_once('../../../protected/autoLoader.class.php');
autoLoader::getFrontController();
autoLoader::initializeTest();

class TestProdutoRecord extends UnitTestCase 
{
    /*
	*testOfStore()
	*testa se a persistência retorna diferente de null
	*e garante a relação entre O usuario e seu Endereco
	*/
    public function testOfStore()
	{
	    try{
	        TTransaction::open();
		
	        $usuario = new usuarioRecord;
		    $usuario->nome = 'Marky Kinpler';
	        $usuario->ddd = '86';
	        $usuario->telefone = '999999';
	        $usuario->email = 'kinopler@direstrits.com';
		    $endereco = $usuario->get_endereco();
			
			if($usuario->get_endereco() > 1):
			   
			    $usuario->id_endereco = (int)$endereco[0]->id+1;				
		        $usuario->senha = crypt('markumarry');
		        $usuario->modify = date('y-m-j');
	            $usuario->created = date('y-m-j');
	            $usuario->permit = 1;
			endif;
			
			if($usuario->get_endereco() <= 1):
			    $usuario->id_endereco = $endereco;
			endif;
			
			$this->assertNotNull($usuario->store());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
		    //se o objeto pdo da transação entrar no catch
			//é que foi lançada uma exception
		    $this->assertNull($usuario->store());
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfUpdate()
	{
	    try{
	        TTransaction::open();
		
	        $usuario = new usuarioRecord;
			$usuario->id = 1;
		    $usuario->nome = 'Jean Pierre Diderot';
	        $usuario->ddd = '82';
	        $usuario->telefone = '33333';
	        $usuario->email = 'jeanpierre@direstrits.com';			
			$usuario->id_endereco = 1;				
		    $usuario->senha = crypt('markumarry');
		    $usuario->modify = date('y-m-j');
	        $usuario->created = date('y-m-j');
	        $usuario->permit = 1;
			
			$this->assertNotNull($usuario->update());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
		    //se o objeto pdo da transação entrar no catch
			//é que foi lançada uma exception
		    $this->assertNull($usuario->update());
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfDestroy()
	{
	    TTransaction::open();
		
	    $usuario=new usuarioRecord;
		$usuario->id = 2;
		$this->assertNotNull($usuario->destroy());
		
		TTransaction::close();
	}
	
	/*
	*testOfGetEndereco()
	*testa se o ultimo endereço id de usuario inserido no banco é retornado e é diferente de Null
	*/
	public function testOfGetEndereco()
	{
	    $usuario=new usuarioRecord;
		$this->assertNotNull($usuario->get_endereco());
	}
	
	public function testOfFindAll()
	{
	    $usuario=new usuarioRecord;
		$colecao=$usuario->findAll(array('limit'=>1000,'order'=>'id'));
		$this->assertNotNull($colecao);
	}
}
?>