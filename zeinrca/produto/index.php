<? 
/* 

?filtro=TODOS&valor=1&pg=0
?filtro=online&valor=1&pg=0
?filtro=buscar&valor=1&pg=0&q=adriano

*/


$mensagem = "<br /><br />Mensagens de Categoria: <br />";
include"../../../config/conexao/iss_connect.php"; 

echo"{\"android\": [\n";  // { "android": [

$banco01 = FN_conexao_banco(5);
$banco00 = FN_conexao_banco(555);
$banco06 = FN_conexao_banco(6);

if($banco01){ // && $banco01

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
    $usuario = $_GET["us"];
	$ordem = $_GET["ordem"];
	
    $grupo = $_GET["g"]; // 3
    $subgrupo = $_GET["sg"]; //003024

   
    if($pagina<1){$pagina=0;}
	//$pagina = $pagina-1;
	$itens_por_pagina = 10;
	$pagina = $pagina *  $itens_por_pagina;	


	if(strlen($grupo)<1){ $grupo = $_POST["GRUPO"];}
	if(strlen($subgrupo)<1){ $subgrupo = $_POST["SUBGRUPO"];}

	 if(strlen($grupo)<1){  $grupo = "1";}
	  if(strlen($subgrupo)<1){  $subgrupo = "001002";}


    if(strlen($filtro)<1){ $filtro = $_POST["filtro"];}
    if(strlen($valor)<1){  $valor = $_POST["valor"];}
    if(strlen($termo)<1){  $termo = $_POST["termo"];}
	if(strlen($ordem)<1){ $ordem = $_POST["ordem"];}

    
    if(strlen($filtro)<1){  $filtro = "todos";}
    if(strlen($valor)<1){  $valor = "1";}
    if(strlen($termo)<1){  $termo = "teste";}
    if(strlen($usuario)<1){  $usuario = "0";}


	switch ($ordem) {
		  case 'DESCRICAO':
				$ordem_filtro =  " ORDER  BY DESCRICAO ASC";  
				 break;
		  case 'NOVIDADES':
				$ordem_filtro =  " ORDER  BY CODCOM DESC "; 
				break;		
		  case 'FORNECEDOR':
				$ordem_filtro =  " ORDER  BY FABRICANTE ASC"; 
				break;	
		 case 'CATEGORIA':
				$ordem_filtro =  " ORDER  BY GRUPO, SUBGRUPO ASC"; 
				break;		
		  case 'CAIXA':
				$ordem_filtro =  " ORDER  BY CAIXA ASC"; 
				break;		
		  default:
				$ordem_filtro =  " ORDER  BY CODCOM DESC"; 
				break;		
	}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}

    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if(strlen($filtro)>0){

		if(strlen($valor)>0){


		$busca_filtro ="";		

		switch ($filtro) {
		  case 'subgrupo':
				$busca_filtro =  " WHERE SUBGRUPOCOD='".$subgrupo."'";  
		 		 break;			
		  case 'todos':
				$busca_filtro =  " WHERE GRUPO='".$grupo."'AND SUBGRUPOCOD='".$subgrupo."'";  
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
				$busca_filtro =  " WHERE GRUPO='".$grupo."' AND SUBGRUPOCOD='".$subgrupo."' "; 
		  		break;
		  case 'codforn':
		  case 'fornecedor':
				$busca_filtro =  " WHERE CODFORN='".$valor."' "; 
		  		break;
		  case 'publicar':
				$busca_filtro =  " WHERE PUBLICAR='".$valor."' "; 
		  		break;
	 	  case 'letra':
				$busca_filtro =  " WHERE DESCRICAO LIKE '".$valor."%' "; 
		  		break;				  		
		  case 'pesquisar':
		  case 'buscar':

				$busca_filtro =  " WHERE 
				 DESCRICAO LIKE '%" .$valor . "%'
				 OR FABRICANTE LIKE '%" .$valor . "%'
				 OR CODCOM LIKE '%" .$valor . "%'
				 OR CODBAR LIKE '%" .$valor . "%'
				 OR REFERENCIA LIKE '%" .$valor . "%'
				 "; 
		  break;
		  case 'semelhante':

				$busca_filtro =  " WHERE 
				 DESCRICAO LIKE '%" .$valor . "%'
				 "; 				 		  		
		}

			//$busca_filtro =  " WHERE usoSetor>0 "; 
			$mensagem .=  "Conectando... <br />";

		 	$sq_us = "SELECT *
		 		FROM  A01_LICENCIADO ".$busca_filtro." 
		 		 ".$ordem_filtro."   LIMIT ".$pagina.",".$itens_por_pagina."  ";
		 		$rs_us = mysql_query( $sq_us, $banco01)  or die(mysql_error($banco01)); // 

				$mensagem .=  "Selecionando Categoria... <br />";

				$contar = 1;
				$total =  mysql_num_rows($rs_us);

				//echo "<H3>" .$sq_us ." <br /> $mensagem</H3>";	
				//exit();

		 		if($total > 0)
				{

					$mensagem .=  "Listando Categorias... <br />";

				   while($linha = mysql_fetch_array($rs_us)) {

 						 $sq_st =" SELECT * FROM  TAB_CATEGORIA WHERE GRUPO='".$linha[GRUPO]."' LIMIT 1 ";
						 $rs_st = mysql_query($sq_st, $banco01) ;
						 $to_st =  mysql_num_rows($rs_st);

								if($to_st > 0)
								{
		
								   while($linha_st = mysql_fetch_array($rs_st))
								   {
										
		
										$GRUPONOME_CATEGORIA = $linha_st['NOME_GRUPO'];  
								   }
		
								}else{
		
									$GRUPONOME_CATEGORIA = "-"; 
								}

	                    
	                    if($banco00){

     						$sq_sort = "SELECT * FROM TAB_SORTIMENTO_TEMP WHERE CODBAR='".$linha[CODBAR]."' ORDER BY SORT_IMG ASC LIMIT 20";
	                    	//$rs_sort = mysql_query($sq_sort, $banco06);
	                    	//$to_sort = mysql_num_rows($rs_sort);
	                    	//$linha_sort = mysql_fetch_array($rs_sort);

	                    	//print_r($linha_sort);
	                    	$to_sort = 1;
	                    }else{

	                    	$to_sort = 1;
	                    }	

	                    // CARRINHO COMPRAS	
	                    if($usuario>0 && $banco00){
 
     						$sq_carrinho = "SELECT * FROM TAB_PEDIDO_APLICATIVO_TEMP WHERE 
     						DESCRICAO='".$linha[CODCOM]."'
     						AND CODUSU='". $usuario ."'  LIMIT 1";
	                    	$rs_carrinho = mysql_query($sq_carrinho, $banco00);
	                    	$to_carrinho = mysql_num_rows($rs_carrinho);

	                    	if($to_carrinho>0){

	                    		$linha_tp= mysql_fetch_array($rs_carrinho);
	                    		$QUANTIDADE = $linha_tp["TOTALITENS"];
	                    		//$QUANTIDADE = "1";

	                    	}else{
	                    		$QUANTIDADE = "0";
	                    	}	

	                    	//print_r($linha_sort);
	                    }else{

	                    	$QUANTIDADE = "0";
	                    }	


						//echo "<H3> sq_carrinho: " .$sq_carrinho ."<br /> to_carrinho: ".$to_carrinho."<br /> QUANTIDADE: ".$QUANTIDADE." <br /></H3>";


						$QUANTIDADE = ($QUANTIDADE > 0) ? $QUANTIDADE : "0";

		  				$PRECO_DE = $linha['PRECO_DE']; 
						$PRECO_POR = $linha['PRECO_POR']; 
						$DESCONTO = $linha['DESCONTO']; 

						//$preco_de = rand(5,50);
					//	$preco_por = rand(5,30);
					//	$desconto = rand(1,9);

						if(strlen($PRECO_DE)<1){  $PRECO_DE = "-";}
						if(strlen($PRECO_POR)<1){  $PRECO_POR = "-";}
						if(strlen($DESCONTO)<1){  $DESCONTO = "-";}


		  				$CODCOM = $linha['CODCOM']; 
						$CODBAR = $linha["CODBAR"];
						$REFERENCIA =  $linha["REFERENCIA"];	
						$DESCRICAO =  $linha["DESCRICAO"];	
						 
						$DESCRICAO = str_replace("      ", " ", $DESCRICAO);
						$DESCRICAO = str_replace("     ", " ", $DESCRICAO);
						$DESCRICAO = str_replace("    ", " ", $DESCRICAO);
						$DESCRICAO = str_replace("   ", " ", $DESCRICAO);
						$DESCRICAO = str_replace("  ", " ", $DESCRICAO);
						$DESCRICAO = str_replace(" ", " ", $DESCRICAO);

						$DESCRICAO = strip_tags($DESCRICAO);
						$DESCRICAO = str_replace("\"","",$DESCRICAO);
						
						$FABRICANTE = $linha["FABRICANTE"];
						$CODFORN =  $linha["CODFORN"];

						$CAIXA =  $linha["CAIXA"];
						$GRUPO =  $linha["GRUPO"];	
						$GRUPONOME = $GRUPONOME_CATEGORIA;	
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
						$SORTIMENTO =	1; //$to_sort;

							
						/// VALIDAR	

						$ORIGEM = ($ORIGEM=='S') ? 'IMPORTADO': "NACIONAL"; 	

						$CODCOM = (strlen($CODCOM)>0) ? $CODCOM : "-"; 
						$CODBAR = (strlen($CODBAR)>0)  ? $CODBAR: "-"; 
						$REFERENCIA = (strlen($REFERENCIA)>0)  ? $REFERENCIA: "-"; 
						$DESCRICAO =  (strlen($DESCRICAO)>0)  ? $DESCRICAO: "-"; 	 

						$FABRICANTE = (strlen($FABRICANTE)>0) ? $FABRICANTE: "-"; 
						$CODFORN = (strlen($CODFORN)>0) ? $CODFORN: "-"; 
						
						$CAIXA = (strlen($CAIXA)>0) ? $CAIXA: "-"; 
						$GRUPO = (strlen($GRUPO)>0) ? $GRUPO: "-"; 
						$GRUPONOME = (strlen($GRUPONOME)>0) ? $GRUPONOME: "-"; 
						$SUBGRUPOCOD = (strlen($SUBGRUPOCOD)>0) ? $SUBGRUPOCOD: "-"; 
					
						$DIMENPC = (strlen($DIMENPC)>0) ? $DIMENPC: "-"; 
						$DIMENCX = (strlen($DIMENCX)>0) ? $DIMENCX: "-"; 
						$ORIGEM = (strlen($ORIGEM)>0) ? $ORIGEM: "-"; 
						$CUBIC = (strlen($CUBIC)>0) ? $CUBIC: "-"; 

						$ATIVO = (strlen($ATIVO)>0) ? $ATIVO: "-"; 
						$IMAGEM = (strlen($IMAGEM)>0) ? $IMAGEM: "-"; 




					if($contar < $total){

					$virgula =", ";
					}else{

					 $virgula ="";	 
					}

echo "{\"ver\": \"".$contar."\",
\"cod\": \"".time()."\",\"api\": \"".$CODBAR."\",\"codcom\": \"".$CODCOM."\",\"codbar\": \"".$CODBAR."\", \"referencia\": \"".$REFERENCIA."\",
\"descricao\": \"".$DESCRICAO."\",\"codforn\": \"".$CODFORN."\", \"fabricante\": \"".$FABRICANTE."\",
\"grupo\": \"".$GRUPO."\",\"gruponome\": \"".$GRUPONOME."\", \"subgrupo\": \"".$SUBGRUPO."\", \"subgrupocod\": \"".$SUBGRUPOCOD."\",
\"origem\": \"".$ORIGEM."\",\"estoque\": \"".$ESTOQUE."\", \"caixa\": \"".$CAIXA."\",  \"cubic\": \"".$CUBIC."\",
\"dimenpc\": \"".$DIMENPC."\",\"dimencx\": \"".$DIMENCX."\", \"ativo\": \"".$ATIVO."\", \"linha\": \"".$LINHA."\",
\"publicar\": \"".$PUBLICAR."\",\"sortimento\": \"".$SORTIMENTO."\",\"quantidade\": \"".$QUANTIDADE."\",\"usr\": \"".$usuario."\",\"precode\": \"".$PRECO_DE."\",\"precopor\": \"".$PRECO_POR."\",\"desconto\": \"".$DESCONTO."\" }".$virgula."\n"; 
			
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