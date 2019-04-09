<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

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
	$itens_por_pagina = 20;
	$pagina = $pagina *  $itens_por_pagina;	
	

    if(strlen($filtro)<1){ $filtro = $_POST["filtro"];}
    if(strlen($valor)<1){  $valor = $_POST["valor"];}
    if(strlen($termo)<1){  $termo = $_POST["termo"];}
    
    if(strlen($filtro)<1){  $filtro = "letra";}
    if(strlen($valor)<1){  $valor = "A";}
    if(strlen($termo)<1){  $termo = "teste";}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}



    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		

		switch ($filtro) {
		  case 'todos':
				$busca_filtro =  " WHERE CODFORN>0"; 
		 		 break;
	  	  case 'codigo':
				$busca_filtro =  " WHERE CODFORN='".$valor."' "; 
		  		break;		 		 
		  case 'publicar':
				$busca_filtro =  " WHERE PUBLICAR='".$valor."' "; 
		  		break;	
		  case 'origem':
				$busca_filtro =  " WHERE ORIGEM='".$valor."' "; 
		  		break;
		  case 'letra':
				$busca_filtro =  " WHERE FABRICANTE LIKE '".$valor."%' "; 
		  		break;
		  case 'grupo':
				$busca_filtro =  " WHERE GRUPO LIKE '".$valor."%' "; 
		  		break;		  		
		  case 'buscar':

				$busca_filtro =  " WHERE 
				 FABRICANTE LIKE '%" .$valor . "%'
				 OR CODFORN LIKE '%" .$valor . "%'
				 "; 
		  		break;			  		
		}


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 	$sq_us = "SELECT *
		 		FROM  	A01_LICENCIADO   
		 		GROUP BY CODFORN
		 		ORDER  BY FABRICANTE ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";

		 		$rs_us = mysql_query( $sq_us, $banco01)or die(mysql_error($banco01)); //  or die(mysql_error())

				$mensagem .=  "Selecionando Categoria... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//echo "<H3>" .$sq_us ."</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Categorias... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {

						 $sq_st =" SELECT * FROM  A01_LICENCIADO WHERE CODFORN='".$linha[CODFORN]."' LIMIT 1 ";
						 $rs_st = mysql_query($sq_st, $banco01) ;
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

				 
				  	//$JSON_Categoria_ATUAL = json_encode($Categoria_dados ); 
				    //echo $JSON_Categoria_ATUAL . "";

		
				    $fnCodigo = $linha['CODFORN']; 
					$fnNome = $linha['FABRICANTE']; 
					$fnSigla = 1; 
					$fnPublicar = 1; 
					$fnTotal = 1; 
					$fnOrdem = 1; 
					

					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}

echo "{\"ver\": \"".$contar."\",\"cod\": \"".time()."\",\"api\": \"".$fnCodigo."\", \"fnCodigo\": \"".$fnCodigo."\",\"fnNome\": \"".$fnNome."\", \"fnSigla\": \"".$fnSigla."\",\"fnPublicar\": \"".$fnPublicar."\", \"fnTotal\": \"".$fnTotal."\",\"fnOrdem\": \"".$fnOrdem."\" }".$virgula." \n"; 
					
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