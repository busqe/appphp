<? header("Pragma: public");
header("Expires: 31536000");
header("Cache-Control: must-revalidate, post-check=900, pre-check=3600");
header("Cache-Control: public");
header("Content-Type: application/javascript");
header("Cache-Control: public, max-age=31536000");
// Clearstatcache()

/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 
$banco01 = FN_conexao_banco(5);
$banco04 = FN_conexao_banco(4);

echo"{\"android\": [\n";  // { "android": [

if($banco01 && $banco04){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
   
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

    //if(!$acao_acesso ){$acao_acesso ="exibir";}



    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		

		switch ($filtro) {
		  case 'todos':
				$busca_filtro =  " WHERE GRUPO>0"; 
		 		 break;
	  	  case 'codigo':
				$busca_filtro =  " WHERE GRUPO='".$valor."' "; 
		  		break;		 		 
		  case 'publicar':
				$busca_filtro =  " WHERE PUBLICAR='".$valor."' "; 
		  		break;	
		  case 'buscar':

				$busca_filtro =  " WHERE 
				 NOME_GRUPO LIKE '%" .$termo . "%'
				 OR NOME_CURTO LIKE '%" .$termo . "%'
				 OR usTotal LIKE '%" .$termo . "%'
				 OR usoNick LIKE '%" .$termo . "%'
				 "; 
		  		break;	
		  case 'origem':
				$busca_filtro =  " WHERE ORIGEM='".$valor."' "; 
		  		break;
		  case 'home':
				$busca_filtro =  " WHERE HOME='".$valor."' "; 
		  		break;
		  case 'slug':
				$busca_filtro =  " WHERE SLUG='".$valor."' "; 
		  		break;
		}


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />"; // 

			    $sq_us = "SELECT * FROM  A01_LICENCIADO GROUP BY GRUPO ORDER  BY GRUPO ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";
		 		 // $sq_us = "SELECT * FROM  TAB_CATEGORIA ".$busca_filtro."  ORDER  BY NOME_GRUPO ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";
		 		$rs_us = mysql_query( $sq_us, $banco01) or die(mysql_error($banco01)); //  or die(mysql_error())

				$mensagem .=  "Selecionando Categoria... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Categorias... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {

						 $sq_st =" SELECT * FROM  TAB_CATEGORIA WHERE GRUPO='".$linha[GRUPO]."' LIMIT 1 ";
						 $rs_st = mysql_query($sq_st, $banco04) or die(mysql_error($banco04));
						 $to_st =  mysql_num_rows($rs_st);
 

				 		if($to_st > 0)
						{

						   while($linha_st = mysql_fetch_array($rs_st))
						   {
						   		//print_r($linha_st);
								
									$ctCodigo = $linha_st['GRUPO']; 
									$ctNome = $linha_st['NOME_GRUPO']; 
									$ctSigla = $linha_st['NOME_ABREV']; 
									$usHome= $linha_st['HOME']; 
									$ctPublicar = $linha_st['PUBLICAR']; 
									$ctTotal = $linha_st['TOTAL']; 
		
										//$linha['TOTAL'] = $to_st;  
										//$CODIGO_IMAGEM = $linha['CODBAR']; 
										
										$linha['TOTAL'] = 1; 
						   }

						}else{

							$linha['TOTAL'] = "0"; 
						}

			
						//echo "<H3>" .$sq_st ." -- ".$linha['TOTAL']."</H3>";	
				 
				  	//$JSON_Categoria_ATUAL = json_encode($Categoria_dados ); 
				    //echo $JSON_Categoria_ATUAL . "";

		
				  //  $ctCodigo = $linha['GRUPO']; 
					//$ctNome = $linha['NOME_GRUPO']; 
					//$ctSigla = $linha['NOME_ABREV']; 
					//$usHome= $linha['HOME']; 
					//$ctPublicar = $linha['PUBLICAR']; 
					//$ctTotal = $linha['TOTAL']; 
	
				
					$codigo_item = rand(5,50);
					$codico = (strlen($ctCodigo)<2) ? "0".$ctCodigo : $ctCodigo;	
					//$ctIcone = "http://www.zein.com.br/hotsite/18/site/licenciados/images/ico_marca_".$linha[SUBGRUPOCOD]."_48.png?tn=".$codigo_item;  
					$ctIcone = "http://www.zein.com.br/ximages/miniaturas/".$linha[CODBAR]."_tumb.jpg?tn=".$codigo_item;  

					if($contar < $total){
						$virgula =", ";
					}else{
						 $virgula ="";	 
					}
					
					if($linha['TOTAL'] > 0)
					//if(1>0)
					{

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$ctCodigo."\", \"ctCodigo\": \"".$ctCodigo."\",\"ctNome\": \"".$ctNome."\", \"ctSigla\": \"".$ctSigla."\",\"ctPublicar\": \"".$ctPublicar."\", \"ctTotal\": \"".$ctTotal."\",\"ctIcone\": \"".$ctIcone."\" }".$virgula." \n"; 
					
					}
					
					$contar ++;
					}

					$mensagem .=  "Total de Categorias: $total <br />";

				}else{ // Categoria

				  $mensagem .=  "Categoria nao encontrado! <br />";
				  echo "{\"ver\":\"false\",\"mensagem\":\"Categoria nao encontrada!\" ,\"syAcesso\":\"1516884933\"}";
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