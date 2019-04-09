<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/

$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 

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


		$busca_filtro ="";		

		switch ($filtro) {
		  case 'todos':
				$busca_filtro =  " WHERE GRUPO>0"; 
		 		 break;
	  	  case 'ean':
				$busca_filtro =  " WHERE CODCOM='".$valor."' "; 
		  		break;		
	  	  case 'codigo':
				$busca_filtro =  " WHERE CODBAR='".$valor."' "; 
		  		break;		
	  	  case 'referencia':
				$busca_filtro =  " WHERE REFERENCIA='".$valor."' "; 
		  		break;			  			  		 		 
		  case 'grupo':
				$busca_filtro =  " WHERE GRUPO='".$valor."' "; 
		  		break;	
		  case 'subgrupo':
				$busca_filtro =  " WHERE SUBGRUPOCOD='".$valor."' "; 
		  		break;
		  case 'codforn':
				$busca_filtro =  " WHERE CODFORN='".$valor."' "; 
		  		break;
		  case 'publicar':
				$busca_filtro =  " WHERE PUBLICAR='".$valor."' "; 
		  		break;
		  case 'buscar':

				$busca_filtro =  " WHERE 
				 DESCRICAO LIKE '%" .$termo . "%'
				 OR FABRICANTE LIKE '%" .$termo . "%'
				 OR CODCOM LIKE '%" .$termo . "%'
				 OR CODBAR LIKE '%" .$termo . "%'
				 OR REFERENCIA LIKE '%" .$termo . "%'
				 "; 		  		
		}


			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 	$sq_us = "SELECT *
		 		FROM  A01_LICENCIADO ".$busca_filtro." 
		 		ORDER  BY DESCRICAO ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";

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

						// $sq_st =" SELECT * FROM  A01_LICENCIADO WHERE CODCOM='".$linha[CODCOM]."' LIMIT 1 ";
						// $rs_st = mysql_query($sq_st, $banco01) ;
						 //$to_st =  mysql_num_rows($rs_st);

		
		  				$CODCOM = $linha['CODCOM']; 
						$CODBAR = $linha["CODBAR"];
						$REFERENCIA =  $linha["REFERENCIA"];	
						$DESCRICAO =  $linha["DESCRICAO"];	

						$FABRICANTE = $linha["FABRICANTE"];
						$CODFORN =  $linha["CODFORN"];

						$CAIXA =  $linha["CAIXA"];
						$GRUPO =  $linha["GRUPO"];	
						$GRUPONOME =  $linha["GRUPONOME"];	
						$SUBGRUPO =  $linha["SUBGRUPO"];	
						$SUBGRUPOCOD =  $linha["SUBGRUPOCOD"];	
						
						$DIMENPC =  $linha["DIMENPC"];
						$DIMENCX =  $linha["DIMENCX"];
						$ORIGEM =  $linha["ORIGEM"];
						$CUBIC =  $linha["CUBIC"];
							
						$ATIVO =  $linha["ATIVO"];
						$LINHA =  $linha["LINHA"];

						$ESTOQUE =	"1";
						$IMAGEM = "1";
						$PUBLICAR =	"1";


					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}

echo "{\"ver\": \"".$contar."\",
\"cod\": \"".time()."\",\"api\": \"".$CODBAR."\",\"codcom\": \"".$CODCOM."\",\"codbar\": \"".$CODBAR."\", \"referencia\": \"".$referencia."\",
\"descricao\": \"".$DESCRICAO."\",\"codforn\": \"".$CODFORN."\", \"fabricante\": \"".$FABRICANTE."\",
\"grupo\": \"".$GRUPO."\",\"gruponome\": \"".$GRUPONOME."\", \"subgrupo\": \"".$SUBGRUPO."\", \"subgrupocod\": \"".$SUBGRUPOCOD."\",
\"origem\": \"".$ORIGEM."\",\"estoque\": \"".$ESTOQUE."\", \"caixa\": \"".$CAIXA."\",  \"cubic\": \"".$CUBIC."\",
\"dimenpc\": \"".$DIMENPC."\",\"dimencx\": \"".$DIMENCX."\", \"ativo\": \"".$ATIVO."\", \"linha\": \"".$LINHA."\",\"publicar\": \"".$PUBLICAR."\" }".$virgula."\n"; 
			
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