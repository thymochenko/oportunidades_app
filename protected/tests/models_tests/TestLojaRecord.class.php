<?php
include_once('../../../protected/autoLoader.class.php');
autoLoader::getFrontController();
autoLoader::initializeTest();

class TestLojaRecord extends UnitTestCase 
{
    /*
	*testOfStore()
	*testa se a persistъncia retorna diferente de null
	*e garante a relaчуo entre O usuario e seu Endereco
	*/
    public function testOfStore()
	{
	    try{
		    //abre transaчуo
	        TTransaction::open();
		    //instancia objeto lojaRecord;
	        $loja = new lojaRecord;
		    $loja->porcentagem_loja = 10.5;
	        $loja->nome = 'Lojas Dragуo';
	        $loja->email_cobranca ='thymochenko@gmail.com' ;
	        $loja->tipo_venda = 'cartao';
	        $loja->moeda = 'real';
	        $loja->tipo_frete = 'simples';
	        $loja->modify = date('y-m-j');
	        $loja->created = date('y-m-j');
	        $loja->permit = 1;
		
			$this->assertNotNull($loja->store());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
		    //se o objeto pdo da transaчуo entrar no catch
			//щ que foi lanчada uma exception
		    $this->assertNull($loja->store());
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
    /*
	*testOfUpdate()
	*testa se a persistъncia retorna diferente de null
	*e garante a relaчуo entre O usuario e seu Endereco
	*/
    public function testOfUpdate()
	{
	    try{
		    //abre transaчуo
	        TTransaction::open();
		    //instancia objeto lojaRecord;
	        $loja = new lojaRecord;
			$loja->id = 1;
		    $loja->porcentagem_loja = 10.5;
	        $loja->nome = 'Lojas Dragуo';
	        $loja->email_cobranca ='thymochenko@gmail.com' ;
	        $loja->tipo_venda = 'cartao';
	        $loja->moeda = 'real';
	        $loja->tipo_frete = 'simples';
	        $loja->modify = date('y-m-j');
	        $loja->created = date('y-m-j');
	        $loja->permit = 1;
		
		    //falha se a mensagem update enviada ao objeto loja retornar null
			$this->assertNotNull($loja->update());
			
		    TTransaction::close();
			
		}catch(TRecordException $e)
		{
		    //se o objeto pdo da transaчуo entrar no catch
			//щ que foi lanчada uma exception
		    $this->assertNull($loja->update());
			//o teste falha se a mensagem store ao objeto usuario for setada
			TTransaction::rollback();
			//desfaz todo o procedimento feito pelo mysql
		}
	}
	
	public function testOfDestroy()
	{
	    TTransaction::open();
		
	    $loja=new lojaRecord;
		$loja->id = 2;
		$this->assertNotNull($loja->destroy());
		
		TTransaction::close();
	}
	
	
	public function testOfFindAll()
	{
	    TTransaction::open();
		
	    $loja=new lojaRecord;
		$colecaoDeLojas=$loja->findAll(array('limit'=>1000,'order'=>'id'));
		$this->assertNotNull($colecaoDeLojas);
		
		TTransaction::close();
	}
}
?>