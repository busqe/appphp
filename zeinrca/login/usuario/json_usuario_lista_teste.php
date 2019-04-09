<? 
//?filtro=TODOS&valor=1&pg=140

$mensagem = "<br /><br />Mensagens de usuario: <br />";
include"../../../../config/conexao/iss_connect.php"; 

echo"{\"android\": [\n";  // { "android": [

if($banco02){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
   
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 20;
	$pagina = $pagina *  $itens_por_pagina;	
	

    if(strlen($filtro)<1){ $filtro = $_POST["filtro"];}
    if(strlen($valor)<1){  $valor = $_POST["valor"];}
    if(strlen($termo)<1){  $termo = $_POST["termo"];}
    //if(!$acao_acesso ){$acao_acesso ="exibir";}





    $mensagem .= "filtro: " . $filtro . " valor: " . $valor . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		

		switch ($filtro) {
		  case 'TODOS':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		 		 break;
		  case 'ONLINE':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;	
		  case 'BUSCAR':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;	
		  case 'ATIVO':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		  case 'INATIVO':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		  case 'ATUALIZADOS':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		  case 'RECENTE':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		  case 'PAGANTE':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		  case 'PAGANTE_NAO':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		  case 'DEBITO':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		  		break;
		}


			$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 	$sq_us = mysql_query("SELECT 
		 		usoCodUso as usCodigo, 
		 		usoNom as usNome, 
		 		usoMail as usEmail,
		 		usoPas as usSenha,
		 		usoNivel as usNivel,
		 		usoSetor as usSetor
		 		FROM  tab_colaborador ".$busca_filtro." ORDER  BY usoNom ASC LIMIT ".$pagina.",".$itens_por_pagina."  ", $banco02);

				$mensagem .=  "Selecionando usuario... <br />";

				$contar = 1;
				$indexar = $pagina;
				$total =  mysql_num_rows($sq_us);

		 		if($total > 0)
				{

					//$indexar = ($contar + $pagina);

					$mensagem .=  "Listando usuarios... <br />";

				   while($linha = mysql_fetch_array($sq_us)) {

						 
						 $rs_setor = mysql_query("SELECT * FROM  tab_setores WHERE setCodSet='".$linha[usSetor]."' LIMIT 1 ", $banco02);
						 $to_setor =  mysql_num_rows($rs_setor);

				 		if($to_setor > 0)
						{

						   while($linha_setor = mysql_fetch_array($rs_setor))
						   {
						   		//print_r($linha_setor);

								$linha['usSetorNome'] = $linha_setor['setNom'];  
						   }
						}else{

							$linha['usSetorNome'] = "--"; 
						}

				 
				  	//$JSON_USUARIO_ATUAL = json_encode($usuario_dados ); 
				    //echo $JSON_USUARIO_ATUAL . "";

		
				    $usCodigo = $linha['usCodigo']; 
					$usNome = $linha['usNome']; 
					$usEmail = $linha['usEmail']; 
					$usSenha= $linha['usSenha']; 
					$usSetor = $linha['usSetor']; 
					$usSetorNome = $linha['usSetorNome']; 
					$usNivel = $linha['usNivel']; 
					

					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}

echo "{\"ver\": \"".$indexar."\",\"cod\": \"".time()."\",\"api\": \"".$usCodigo."\", \"usCodigo\": \"".$usCodigo."\",\"usNome\": \"".$usNome."\", \"usEmail\": \"".$usEmail."\",\"usSetor\": \"".$usSetor."\", \"usSetorNome\": \"".$usSetorNome."\",\"usNivel\": \"".$usNivel."\" }".$virgula." \n"; 
					

					$indexar = ($contar + $pagina);
					$contar ++;
					}

					$mensagem .=  "Total de usuarios: $total <br />";

				}else{ // usuario

				  $mensagem .=  "Usuario nao encontrado! <br />";
				  echo "{\"ver\":\"false\",\"mensagem\":\"Usuario nao encontrado!\" ,\"syAcesso\":\"1516884933\"}";
				}

		}else{ // valor
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma valor!\" ,\"syAcesso\":\"1516884933\"}";
		}
 
	}else{ // filtro
		$mensagem .=  "Selecione um filtro!<br />";
		echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma filtro!\" ,\"syAcesso\":\"1516884933\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"ver\":\"false\",\"mensagem\":\"Erro ao conectar!\" ,\"syAcesso\":\"1516884933\"}";
}


echo "]}";



if($_GET["s"]==1){

 
//echo($mensagem . "");
//echo $praonde;
}	

?>