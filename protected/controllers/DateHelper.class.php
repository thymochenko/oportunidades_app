<?php
class DateHelper
{
    /**
	* Esta funчуo retorna uma data escrita da seguinte maneira:
	* Exemplo: Terчa-feira, 17 de Abril de 2007
	* @author Leandro Vieira Pinho [http://leandro.w3invent.com.br]
	* @param string $strDate data a ser analizada; por exemplo: 2007-04-17 15:10:59
	* @return string
	*/
	public static function dataPorExtenso($strDate)
	{
		// Array com os dia da semana em portuguъs;
		$arrDaysOfWeek = array('Domingo', 'Segunda-feira', 'Terчa-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sсbado');
		// Array com os meses do ano em portuguъs;
		$arrMonthsOfYear = array(1 => 'Janeiro', 'Fevereiro', 'Marчo', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
		// Descobre o dia da semana
		$intDayOfWeek = date('w',strtotime($strDate));
		// Descobre o dia do mъs
		$intDayOfMonth = date('d',strtotime($strDate));
		// Descobre o mъs
		$intMonthOfYear = date('n',strtotime($strDate));
		// Descobre o ano
		$intYear = date('Y',strtotime($strDate));
		// Formato a ser retornado
		return $arrDaysOfWeek[$intDayOfWeek] . ', ' . $intDayOfMonth . ' de ' . $arrMonthsOfYear[$intMonthOfYear] . ' de ' . $intYear;
	}
	
	public static function timeStampToMysqlDateTime($timestamp_converte)
	{
		//criamos $nova_data para converter esse timestamp para data atual
		$new_data = date("Y-m-d H:i:s", $timestamp_converte);
		return $new_data;
	}
	
	public function convertToPt($date){
		$newdate =  implode("/",array_reverse(explode("-",$date)));
		return $newdate;
	}
}
/*
$date1 = new DateTime(DateHelper::timeStampToMysqlDateTime('1172869567'));
$date2 = new DateTime(DateHelper::timeStampToMysqlDateTime('1071859567'));

var_dump($date1 > $date2);
*/
?>