<? 
/* 

?filtro=grupo&valor=1&pg=0

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 
$banco01 = FN_conexao_banco(5);

echo"{\"android\": [\n";  // { "android": [

if($banco01){

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
   
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 50;
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


 			  if($valor=="todos"){
 			  	  $grupo_busca = "GRUPO>0";
 			  }else{
 				  $grupo_busca = "GRUPO=" . $valor;
 			  }


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conescando... <br />";

		 	$sq_us = "SELECT * FROM  A01_LICENCIADO WHERE ".$grupo_busca."
		 		AND LENGTH(SUBGRUPOCOD)>0
		 		AND LENGTH(SUBGRUPO)>0
		 		GROUP BY SUBGRUPO
		 		ORDER  BY SUBGRUPO ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";
		 		$rs_us = mysql_query( $sq_us, $banco01)or die(mysql_error($banco01)); //  or die(mysql_error())

				$mensagem .=  "Selecionando Categoria... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//ho "<H3>" .$sq_us ."</H3>";	
				//exit();



		 		if($total > 0)
				{

					$mensagem .=  "Listando Categorias... <br />";

					  while($linha = mysql_fetch_array($rs_us)) {



						  	$sq_st =" SELECT * FROM  A01_LICENCIADO 
						  	WHERE SUBGRUPOCOD = '".$linha[SUBGRUPOCOD]."' 
						  	AND IMAGEM = 1
						  	LIMIT 1 ";
							 $rs_st = mysql_query($sq_st, $banco01) ;
							 $to_st =  mysql_num_rows($rs_st);

					 		if($to_st > 0)
							{

							   while($linha_st = mysql_fetch_array($rs_st))
							   {
							   		//print_r($linha_st);

									$CODIGO_IMAGEM = $linha['CODBAR'];
							   }

							}else{

								$CODIGO_IMAGEM = "semfoto"; 
							}


		
				    $scCodigo = $linha['SUBGRUPOCOD']; 
					$scNome = $linha['SUBGRUPO']; 
					$scGrupo = $linha['GRUPO']; 
					$usHome= $linha['SUBGRUPO']; 
					$scPublicar = 1; 
					$scTotal = 1; 
					$codigo = (strlen($scCodigo)<6) ? "0".$scCodigo : $scCodigo;



					$scIcone = "http://www.zein.com.br/ximages/miniaturas/".$CODIGO_IMAGEM."_tumb.jpg";

					if($contar < $total)
					{
						$virgula =", ";
					}else{

						 $virgula ="";	 
					}

//$somar = $contar +1;
echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$scCodigo."\", \"scCodigo\": \"".$scCodigo."\",\"scNome\": \"".$scNome."\", \"scGrupo\": \"".$scGrupo."\",\"scPublicar\": \"".$scPublicar."\", \"scTotal\": \"".$scTotal."\",\"scIcone\": \"".$scIcone."\" }".$virgula." \n"; 
					
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
	$mensagem .=  "Erro ao conescar!<br />";
	echo "{\"ver\":\"false\",\"mensagem\":\"Erro ao conescar!\" ,\"syAcesso\":\"1516884933\"}";
}


echo "]}";



if($_GET["s"]==1){

 
echo($mensagem . "");
//echo $praonde;
}	

?>