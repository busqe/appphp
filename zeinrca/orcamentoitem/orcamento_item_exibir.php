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
$banco00 = FN_conexao_banco(6);
$banco00 = FN_conexao_banco(555);

if($banco01){ 

    $filtro = $_GET["filtro"];
    $valor = $_GET["valor"];
    $termo = $_GET["q"];
    $pagina = $_GET["pg"];
    $usuario = $_GET["us"];
    $link = $_GET["link"];
   
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
    if(strlen($link)<1){  $link = "0";}

    //if(!$acao_acesso ){$acao_acesso ="exibir";}

    $mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- termo: " . $termo . "<br />";


	if($usuario > 0){ 

		if($link > 0){

		//$busca_filtro =  " WHERE usoSetor>0 "; 
		$mensagem .=  "Conectando... <br />";

 		$sq_us = "SELECT *
 		FROM  TAB_PEDIDO_APLICATIVO WHERE 
 		CODLINK=".$link." 
 		AND CODBAR='".$valor."'
 		ORDER  BY DESCRICAO ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";

 		$rs_us = mysql_query( $sq_us, $banco00)or die(mysql_error($banco00)); //  or die(mysql_error())

		$mensagem .=  "Selecionando Categoria... <br />";

		$contar = 1;
		$total =  mysql_num_rows($rs_us);

		//echo "<H3>" .$sq_us ." <br /> $mensagem</H3>";	
		//exit();

	 	if($total > 0)
		{

			$mensagem .=  "Listando Categorias... <br />";

			while($linha = mysql_fetch_array($rs_us)) {

		 	//----- CATEGORIAS

			if($banco01){

			 $sq_st =" SELECT * FROM  TAB_CATEGORIA WHERE
			  GRUPO='".$linha[GRUPO]."' LIMIT 1 ";
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
			}
        
       		 //----- SORTIMENTOS

	        if($banco00){

				$sq_sort = "SELECT * FROM TAB_SORTIMENTO_TEMP WHERE
				CODBAR='".$linha[CODBAR]."' ORDER BY SORT_IMG ASC LIMIT 20";
	        	$rs_sort = mysql_query($sq_sort, $banco06);
	        	$to_sort = mysql_num_rows($rs_sort);
	        	//$linha_sort = mysql_fetch_array($rs_sort);

	        	//print_r($linha_sort);
	        }else{

	        	$to_sort = 1;
	        }	


 

 

			//----- PRODUTOS

			$PRECO_DE = $linha['PRECO_DE']; 
			$PRECO_POR = $linha['PRECO_POR']; 
			$DESCONTO = $linha['DESCONTO']; 

			//$PRECO_DE = rand(5,50) . ",00";
			//$PRECO_POR = rand(5,30) . ",00";
			//$DESCONTO = rand(1,9) ;

			if(strlen($PRECO_DE)<1){  $PRECO_DE ="-";}
			if(strlen($PRECO_POR)<1){  $PRECO_POR = "-";}
			if(strlen($DESCONTO)<1){  $DESCONTO = "-";}


	        $QUANTIDADE = $linha["QUANTIDADE"];
	         $QUANTIDADE = ( $QUANTIDADE>0) ?  $QUANTIDADE : 1; 

			$CODLINK = $linha['CODLINK']; 
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
			$SORTIMENTO =	$to_sort;

				
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
\"cod\": \"".time()."\",\"api\": \"".$CODBAR."\",\"codlink\": \"".$CODLINK."\",\"codcom\": \"".$CODCOM."\",\"codbar\": \"".$CODBAR."\", \"referencia\": \"".$REFERENCIA."\",
\"descricao\": \"".$DESCRICAO."\",\"codforn\": \"".$CODFORN."\", \"fabricante\": \"".$FABRICANTE."\",
\"grupo\": \"".$GRUPO."\",\"gruponome\": \"".$GRUPONOME."\", \"subgrupo\": \"".$SUBGRUPO."\", \"subgrupocod\": \"".$SUBGRUPOCOD."\",
\"origem\": \"".$ORIGEM."\",\"estoque\": \"".$ESTOQUE."\", \"caixa\": \"".$CAIXA."\",  \"cubic\": \"".$CUBIC."\",
\"dimenpc\": \"".$DIMENPC."\",\"dimencx\": \"".$DIMENCX."\", \"ativo\": \"".$ATIVO."\", \"linha\": \"".$LINHA."\",
\"publicar\": \"".$PUBLICAR."\",\"sortimento\": \"".$SORTIMENTO."\",\"quantidade\": \"".$QUANTIDADE."\",\"usr\": \"".$usuario."\",\"precode\": \"".$PRECO_DE."\",\"precopor\": \"".$PRECO_POR."\",\"desconto\": \"".$DESCONTO."\" }".$virgula."\n"; 
			
				$contar ++;
				}

				$mensagem .=  "Total de listas: $total <br />";

			}else{ // 

			  $mensagem .=  "Categoria nao encontrado! <br />";
			  echo "{\"ver\":\"false\",\"mensagem\":\"itens nao encontrados!\" ,\"syAcesso\":\"".time()."\"}";
			}

		}else{ // valor
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"ver\":\"false\",\"mensagem\":\"Selecione uma lista!\" ,\"syAcesso\":\"".time()."\"}";
		}
 
	}else{ // filtro
		$mensagem .=  "Selecione um filtro!<br />";
		echo "{\"ver\":\"false\",\"mensagem\":\"Selecione um usuario!\" ,\"syAcesso\":\"".time()."\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"ver\":\"false\",\"mensagem\":\"Erro ao conectar!\" ,\"syAcesso\":\"".time()."\"}";
}


echo "]}";



if($_GET["s"]==1){

 
echo($mensagem . "");
//echo $praonde;
}	

?>