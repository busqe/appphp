<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Orcamento: <br />";
include"../../../config/conexao/iss_connect.php"; 

$banco00 = FN_conexao_banco(555);
$banco02 = FN_conexao_banco(2);

echo"{\"android\": [\n";  // { "android": [

if($banco00){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
    $usuario = $_GET["us"];
   
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 10;
	$pagina = $pagina *  $itens_por_pagina;	

    if(strlen($filtro)<1){ $filtro = $_POST["filtro"];}
    if(strlen($valor)<1){  $valor = $_POST["valor"];}
    if(strlen($termo)<1){  $termo = $_POST["termo"];}
    
    if(strlen($filtro)<1){  $filtro = "todos";}
    if(strlen($valor)<1){  $valor = "1";}
    if(strlen($termo)<1){  $termo = "teste";}
	if(strlen($usuario)<1){  $usuario = "0";}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}

    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 	$sq_us = "SELECT *
	
		 		FROM  TAB_PEDIDO_APLICATIVO_CAT 
		 		WHERE CODUSO='".$usuario."'
		 		ORDER  BY CODLINK DESC LIMIT ".$pagina.",".$itens_por_pagina."  ";

		 		$rs_us = mysql_query( $sq_us, $banco00)or die(mysql_error($banco00)); //  or die(mysql_error())

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();
				$mensagem .=  "Selecionando Orcamento do usuario ".$usuario." -- 
				Total: ".$total."	
				<br />";

		 		if($total > 0)
				{

				   $mensagem .=  "Listando Orcamentos... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {

						 $sq_st =" SELECT * FROM  TAB_PEDIDO_APLICATIVO 
						 WHERE CODLINK='".$linha[CODLINK]."' ";
						 $rs_st = mysql_query($sq_st, $banco00) ;
						 $to_st =  mysql_num_rows($rs_st);

				 		if($to_st > 0)
						{

						   while($linha_st = mysql_fetch_array($rs_st))
						   {
						   		//print_r($linha_st);

								$linha['TOTAL'] = $to_st;  
						   }

						}else{

							$linha['TOTAL'] = "0"; 
						}

				  	//$JSON_Orcamento_ATUAL = json_encode($Orcamento_dados ); 
				    //echo $JSON_Orcamento_ATUAL . "";
		
				    $orCodigo = $linha['CODLINK']; 
					//$orNome = $linha['DESCRICAO']; 
					$orNome = "ORCAMENTO " . $orCodigo; 
					$orUsr = $linha['CODUSO']; 
					$orData= $linha['DATACRIA']; 
					$orStatus = $linha['ESTATUS']; 
					$orTotal = $linha['TOTAL']; 

					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$orCodigo."\", \"orCodigo\": \"".$orCodigo."\",\"orNome\": \"".$orNome."\", \"orUsr\": \"".$orUsr."\",\"orStatus\": \"".$orStatus."\", \"orTotal\": \"".$orTotal."\",\"orData\": \"".$orData."\" }".$virgula." \n"; 
					
					$contar ++;
					}

					$mensagem .=  "Total de Orcamentos: $total <br />";

				}else{ // Orcamento

				  $mensagem .=  "Orcamento nao encontrado! <br />";
				  echo "{\"ver\":\"false\",\"mensagem\":\"Orcamento nao encontrado!\" ,\"syAcesso\":\"".time()."\"}";
				}

		}else{ // valor
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"ver\":\"false\",\"mensagem\":\"Selecione um valor!\" ,\"syAcesso\":\"".time()."\"}";
		}
 
	}else{ // filtro
		$mensagem .=  "Selecione um filtro!<br />";
		echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma filtro!\" ,\"syAcesso\":\"".time()."\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao coneorar!<br />";
	echo "{\"ver\":\"false\",\"mensagem\":\"Erro ao coneorar!\" ,\"syAcesso\":\"".time()."\"}";
}


echo "]}";



if($_GET["s"]==1){

	echo($mensagem . "");
//echo $praonde;
}	

?>