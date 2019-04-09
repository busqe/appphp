<? 
/* 
?filtro=pedido&valor=aberto&us=20&pg=0
*/

$mensagem = "<br /><br />Mensagens de Carrinho: <br />";
include"../../../config/conexao/iss_connect.php"; 

$banco00 = FN_conexao_banco(555);
$banco01 = FN_conexao_banco(5);
$banco02 = FN_conexao_banco(2);

echo"{\"android\": [\n";  // { "android": [

if($banco01 && $banco00){

$filtro = $_GET["filtro"];
$valor = $_GET["valor"];
$usuario = $_GET["us"];
$pagina = $_GET["pg"];

if($pagina<1){$pagina=0;}
//$pagina = $pagina-1;
$itens_por_pagina = 10;
$pagina = $pagina *  $itens_por_pagina;	


if(strlen($filtro)<1){$filtro    = $_POST["filtro"];}
if(strlen($valor)<1){$valor 	  = $_POST["valor"];}
if(strlen($usuario)<1){$usuario = $_POST["usuario"];}

if(strlen($filtro)<1){  $filtro = "todos";}
if(strlen($valor)<1){  $valor = "todos";}
if(strlen($usuario)<1){  $usuario = "0";}// 68


$CODIGO_USUARIO_ACESSO = (strlen($usuario)>0) ? $usuario : "0";
//if(!$acao_acesso ){$acao_acesso ="exibir";}


$mensagem .= "filtro: " . $filtro . "-- valor: " . $valor . " -- usuario: " . $usuario . "<br />";

if(strlen($filtro)>0){

	if(strlen($valor)>0){
	$contar = 1;

	$busca_filtro ="";		


	//$busca_filtro =  " WHERE usoSetor>0 "; 
	$mensagem .=  "Conectando... <br />";
	$mensagem .=  "Selecionando Produto... <br />";


	$sq_us = "SELECT * FROM TAB_PEDIDO_APLICATIVO_TEMP WHERE CODUSU='". $usuario ."' 
	ORDER BY DESCRICAO ASC LIMIT ".$pagina.",".$itens_por_pagina."  ";
	$rs_us = mysql_query( $sq_us, $banco00)or die(mysql_error($banco00)); 
	$total =  mysql_num_rows($rs_us);

		//exit();

 		if($total > 0)
		{

			$mensagem .=  "Listando Carrinhos... <br />";

		   while($linha_tp = mysql_fetch_array($rs_us)) {

		   //	print_r($linha_tp);



				   	$CAR_CODLINK = $linha_tp[CODLINK]; // 19
				    $CAR_TIPOLINK = $linha_tp[TIPOLINK]; // 0
				    $CAR_CODUSU = $linha_tp[CODUSU]; // 68
				    $CAR_NOMEUSU = $linha_tp[NOMEUSU]; // ISSAM
				    $CAR_EMAILUSU = $linha_tp[EMAILUSU]; // issam@zein.com.br
				    $CAR_DESCRICAO = $linha_tp[DESCRICAO]; // 7899658327408
				    $CAR_NOME = $linha_tp[NOME]; // LISTA_PRODUTOS_TEMP
				    $CAR_TOTALITENS = $linha_tp[TOTALITENS]; // 0
				    $CAR_ARQUIVO = $linha_tp[ARQUIVO]; // 
				    $CAR_DATACRI = $linha_tp[DATACRI]; // 15/04/2018
				    $CAR_DATAMOD = $linha_tp[DATAMOD]; // 15/04/2018 


	    		$sq_tp =" SELECT * FROM  A01_LICENCIADO WHERE CODCOM='".$linha_tp[DESCRICAO]."' LIMIT 1 ";
				$rs_tp = mysql_query($sq_tp, $banco01) ;
		 		$to_tp =  mysql_num_rows($rs_tp);

				if($to_tp > 0)
				{

				   while($linha = mysql_fetch_array($rs_tp))
				   {

		  				$PRECO_DE = $linha['PRECO_DE']; 
						$PRECO_POR = $linha['PRECO_POR']; 
						$DESCONTO = $linha['DESCONTO']; 

						//$preco_de = rand(5,50);
						//$preco_por = rand(5,30);
						//$desconto = rand(1,9);

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


						//$DESCRICAO = str_replace("\"", "´", $DESCRICAO); 
						//$DESCRICAO = str_replace(chr(22)  , "´", $DESCRICAO);
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
						$SORTIMENTO =	"1";


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

 
				   }
				
					$DADOS_PRODUTO = "1"; 
				}else{

					$DADOS_PRODUTO = "0"; 
				}

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

				$SORTIMENTO = ($SORTIMENTO > 0) ? $SORTIMENTO : "1"; 
				$CAR_TOTALITENS = ($CAR_TOTALITENS > 0) ? $CAR_TOTALITENS : "1"; 



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
\"publicar\": \"".$PUBLICAR."\",\"sortimento\": \"".$SORTIMENTO."\",\"quantidade\": \"".$CAR_TOTALITENS."\" ,\"precode\": \"".$PRECO_DE."\",\"precopor\": \"".$PRECO_POR."\",\"desconto\": \"".$DESCONTO."\" }".$virgula."\n"; 
	
			$contar ++;
			}

			$mensagem .=  "Total de Carrinhos: $total <br />";

		}else{ // Carrinho

		  $mensagem .=  "Carrinho nao encontrado! <br />";
		  echo "{\"ver\":\"false\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"200\",\"msg\":\"Carrinho nao encontrado!\" ,\"syAcesso\":\"".time()."\"}";
		}

}else{ // valor
	$mensagem .=  "Selecione uma acao!<br />";
	echo "{\"ver\":\"false\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"201\",\"msg\":\"Selecione uma valor!\" ,\"syAcesso\":\"".time()."\"}";
}

}else{ // filtro
	$mensagem .=  "Selecione um filtro!<br />";
	echo "{\"ver\":\"false\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"202\",\"msg\":\"Selecione uma filtro!\" ,\"syAcesso\":\"".time()."\"}";
}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"ver\":\"false\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"203\",\"msg\":\"Erro ao conectar!\" ,\"syAcesso\":\"".time()."\"}";
}


echo "]}";



if($_GET["msg"]==1){

	echo($mensagem . "");
//echo $praonde;
}	

?>