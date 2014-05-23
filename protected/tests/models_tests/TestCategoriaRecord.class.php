<?php
include_once('../../../protected/autoLoader.class.php');
autoLoader::getFrontController();
autoLoader::initializeTest();

class TestCategoriaRecord extends UnitTestCase 
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
			
		    $categoria=new categoriaRecord; 
			$categoria->nome = 'Domщsticos';
	        $categoria->modify = date('y-m-j');
	        $categoria->created = date('y-m-j');
	        $categoria->permit = 1;
	        
			$this->assertNotNull($categoria->store());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
		    //se o objeto pdo da transaчуo entrar no catch
			//щ que foi lanчada uma exception
		    $this->assertNull($categoria->store());
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfUpdate()
	{
	    try{
	        TTransaction::open();
			
		    $categoria=new categoriaRecord;
            $categoria->id = 2;			
			$categoria->nome = 'Teste';
	        $categoria->modify = date('y-m-j');
	        $categoria->created = date('y-m-j');
	        $categoria->permit = 1;
	        
			$this->assertNotNull($categoria->update());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
		    //se o objeto pdo da transaчуo entrar no catch
			//щ que foi lanчada uma exception
		    $this->assertNull($categoria->update());
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfDestroy()
	{
	    TTransaction::open();
		
	    $categoria=new categoriaRecord;
		$categoria->id = 2;
		$this->assertNotNull($categoria->destroy());
		
		TTransaction::close();
	}
	
	
	
	public function testOfFindAll()
	{
	    TTransaction::open();
		
	    $categoria=new categoriaRecord;
		$categoria=$categoria->findAll(array('limit'=>1,'order'=>'id'));
		$this->assertNotNull($categoria);
		
		TTransaction::close();
	}
}
?>