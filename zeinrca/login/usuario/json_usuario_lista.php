<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=juliana

*/

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
    
    if(strlen($filtro)<1){  $filtro = "todos";}
    if(strlen($valor)<1){  $valor = "1";}
    if(strlen($termo)<1){  $termo = "teste";}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}



    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		

		switch ($filtro) {
		  case 'TODOS':
		  case 'todos':
				$busca_filtro =  " WHERE usoCodUso>0 "; 
		 		 break;
	  	  case 'codigo':
				$busca_filtro =  " WHERE usoCodUso=".$valor." "; 
		  		break;		 		 
		  case 'online':
				$busca_filtro =  " WHERE UsoOnline='".$valor."' "; 
		  		break;	
		  case 'buscar':

				$busca_filtro =  " WHERE 
				 usoNom LIKE '%" .$termo . "%'
				 OR usoRazSoc LIKE '%" .$termo . "%'
				 OR usoMail LIKE '%" .$termo . "%'
				 OR usoNick LIKE '%" .$termo . "%'
				 "; 
		  		break;	
		  case 'ativo':
				$busca_filtro =  " WHERE usoPub=".$valor." "; 
		  		break;
		  case 'nivel':
				$busca_filtro =  " WHERE usoNivel=".$valor." "; 
		  		break;
		  case 'chefe':
				$busca_filtro =  " WHERE usoGerente=".$valor." "; 
		  		break;		  		
		  case 'setor':
				$busca_filtro =  " WHERE usoSetor=".$valor." "; 
		  		break;
	
		}


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 	$sq_us = "SELECT 
		 		usoCodUso as usCodigo, 
		 		usoNom as usNome, 
		 		usoMail as usEmail,
		 		usoPas as usSenha,
		 		usoNivel as usNivel,
		 		usoSetor as usSetor
		 		FROM  tab_colaborador ".$busca_filtro." 
		 		ORDER  BY usoNom ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";

		 		$rs_us = mysql_query( $sq_us, $banco02); //  or die(mysql_error())

				$mensagem .=  "Selecionando usuario... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando usuarios... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {

						 $sq_setor =" SELECT * FROM  tab_setores WHERE setCodSet='".$linha[usSetor]."' LIMIT 1 ";
						 $rs_setor = mysql_query($sq_setor, $banco02) ;
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

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$usCodigo."\", \"usCodigo\": \"".$usCodigo."\",\"usNome\": \"".$usNome."\", \"usEmail\": \"".$usEmail."\",\"usSetor\": \"".$usSetor."\", \"usSetorNome\": \"".$usSetorNome."\",\"usNivel\": \"".$usNivel."\" }".$virgula." \n"; 
					
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

 
echo($mensagem . "");
//echo $praonde;
}	

?>