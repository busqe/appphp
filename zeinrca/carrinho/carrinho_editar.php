<?
// acao = inserir, alterar, excluirexcluir,   

//inserir   ?codigo=7899658327408&acao=inserir&us=68
//alterar   ?codigo=7899658392017&acao=alterar&qtd=5&us=68
//excluir   ?codigo=7899658327408&acao=excluir&us=68
//finalizar ?acao=finalizar&us=68

include"../../../config/conexao/iss_connect.php"; 
include"model_usuario.php"; 	
	

	$banco00 = FN_conexao_banco(555);
	$banco01 = FN_conexao_banco(5);
	$banco02 = FN_conexao_banco(2);
	
	$quebralinha = "";
echo"{\"android\": [";  // { "android": [

	// 7899658373993 -- AMY POP
	//  $CODUSO = 104 -- 20

	 $mensagem = "Iniciando acesso... ".$quebralinha.""; 
 
	$CODUSO = $_GET["us"];  
	$CODCOM = $_GET["codigo"];
	$ACAO = $_GET["acao"];
	$QUANTIDADE  = $_GET["qtd"];

	if(!$CODCOM){ $CODCOM = "0";}  // 7899658373993
	if($CODUSO<1){ $CODUSO = "0";}  // usuario:  // 68
	if(!$ACAO){ $ACAO = "inserir";}  
	if($QUANTIDADE<1){ $QUANTIDADE = 1;}  


	if($CODUSO>0){ 
		

 		$linha_usuario = fn_usuario_selecionar($CODUSO, $banco00);
		//exit();
		
		
		if(!$linha_usuario)
		{
			 	$mensagem_usuario .= "Usuario nao encontrado!".$quebralinha.""; 
				echo "{\"ver\":\"".$mensagem_status."\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"msg\":\"".$mensagem_usuario."\",\"syAcesso\":\"".time()."\"}";

		}else{
		 // tudo OK
		    $mensagem .= "Usuario conectado! ".$quebralinha."";
		  
 
			$CODIGO_USUARIO_ACESSO		 =  $linha_usuario['usoCodUso'];
			$EMAIL_USUARIO_ACESSO 		 =  $linha_usuario['usoMail'];
			$SENHA_USUARIO_ACESSO 		 =  $linha_usuario['usoPas'];
			$NIVEL_USUARIO_ACESSO 		 =  $linha_usuario['usoNivel'];
			$SETOR_USUARIO_ACESSO 		 =  $linha_usuario['usoSetor'];
			$NOME_USUARIO_ACESSO 		 =  $linha_usuario['usoNom'];
			$SETORNOME_USUARIO_ACESSO    =  $linha_usuario['usoSetorNome'];
		  
	
			$DATA_BUSCA_USUARIO = date("d/m/Y") . " "; // . date("H:i:s")	
			$LINK_HOJE 	 = date("Ymd") . " "; // . date("H:i:s")			
			$CODLINK 			= time();
			$CODUSU	 	 	 =  $CODIGO_USUARIO_ACESSO;
			$NOMEUSU 	 	 =  $NOME_USUARIO_ACESSO;
			$EMAILUSU 		 =  $EMAIL_USUARIO_ACESSO;
			$DESCRICAO  	 =  $CODCOM;
			$TOTALITENS 	 =  $qtde_registro;
			$DATACRI 		 =  $DATA_BUSCA_USUARIO;
			$DATAMOD 		 =  $DATA_BUSCA_USUARIO;
		
	

switch ($ACAO) {
	case 'inserir':

			
	if(strlen($CODCOM)==13 && is_numeric($CODCOM)){
		
		 $campos_pesquisar_busca = "SELECT * FROM  A01_LICENCIADO WHERE CODCOM LIKE '".$CODCOM . "' LIMIT 1";
		 $sql_buscar = mysql_query($campos_pesquisar_busca, $banco01);
		 $tot_buscar = mysql_num_rows($sql_buscar);	
 
		 if($tot_buscar>0){
			$linha_busca = mysql_fetch_array($sql_buscar);
	 
			  $CODCOM = $linha_busca["CODCOM"];
			  $sql_checar = mysql_query("SELECT * FROM  TAB_PEDIDO_APLICATIVO_TEMP 
			  	WHERE DESCRICAO LIKE '".$CODCOM."'
			  	 AND CODUSU=". $CODIGO_USUARIO_ACESSO." LIMIT 1", $banco00);
			  $tot_checar = mysql_num_rows($sql_checar);	
	
				if($tot_checar<1){
				// GRAVA
					$sq_grava_busca = "INSERT INTO
					 TAB_PEDIDO_APLICATIVO_TEMP(CODUSU, NOMEUSU, EMAILUSU, DESCRICAO, TOTALITENS,DATACRI, DATAMOD)
					 VALUES('".$CODUSU."','".$NOMEUSU."','".$EMAILUSU."','".$DESCRICAO."','".$QUANTIDADE."','".$DATACRI."','".$DATAMOD."')";
					//$sq_grava_busca = "INSERT INTO TAB_PEDIDO_APLICATIVO_TEMP(DESCRICAO)VALUES('".$DESCRICAO."')";
					$rs_grava_busca = mysql_query($sq_grava_busca, $banco00);	



					$sq_apagar = "DELETE FROM TAB_PEDIDO_APLICATIVO_TEMP 
					WHERE DESCRICAO = '".$CODCOM."' 
					AND CODUSU = '".$CODIGO_USUARIO_ACESSO."' ";
					//$rs_apagar = mysql_query($sq_apagar, $banco00);	


					
						$mensagem_inserir .= "Item: ".$CODCOM." INSERIDO com sucesso no Orcamento!".$quebralinha."";
						$mensagem_status = "true";
						$mensagem_codigo = 100;	
				}else{
						$mensagem_inserir .= "O item: ".$CODCOM." ja EXISTE no Orcamento!".$quebralinha."";
						$mensagem_status = "false";
						$mensagem_codigo = 101;				
				}
		 }else{
				  $mensagem_inserir .= "O item: ".$CODCOM." nao foi ENCONTRADO! ".$quebralinha."";
				  $mensagem_status = "false";
				  $mensagem_codigo = 102;			
		 }
	 }else{
		  $mensagem_inserir .= "O Codigo: ".$CODCOM." esta INCORRETO! ".$quebralinha."";
		  $mensagem_status = "false";
		  $mensagem_codigo = 103;			
	 }

	$mensagem .= $mensagem_inserir;	
	echo "{\"ver\":\"".$mensagem_status."\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"".$mensagem_codigo."\",\"msg\":\"".$mensagem_inserir."\",\"syAcesso\":\"".time()."\"}";
	//exit();
	break;
	case 'alterar':
		# alterar quantidade 

	if(strlen($CODCOM)==13 && ($QUANTIDADE>0)){
	 
		 $sq_busca = "SELECT * FROM TAB_PEDIDO_APLICATIVO_TEMP 
		 WHERE DESCRICAO= '".$CODCOM."' 
		 AND CODUSU = '".$CODIGO_USUARIO_ACESSO."'
		 LIMIT 1
		 ";
		 $rs_busca = mysql_query($sq_busca, $banco00);
		 $to_busca = mysql_num_rows($rs_busca);	
		// $mensagem_alterar .= "SQL: ".$sq_busca."".$quebralinha."";	


			 if($to_busca>0){
				$ln_busca = mysql_fetch_array($rs_busca);

				$QUANTIDADE_CHECAR = $ln_busca["TOTALITENS"];
				if($QUANTIDADE_CHECAR==$QUANTIDADE)
				{
					$QUANTIDADE_NOVA = $QUANTIDADE_CHECAR;	
				}else{
					$QUANTIDADE_NOVA = $QUANTIDADE;
				}

				//$mensagem_alterar .= "QUANTIDADE_CHECAR: ".$QUANTIDADE_CHECAR." ".$quebralinha."";	

				$sq_grava_busca = "UPDATE TAB_PEDIDO_APLICATIVO_TEMP SET
				TOTALITENS='".$QUANTIDADE_NOVA."'  
				WHERE DESCRICAO= '".$CODCOM."' 
				AND CODUSU = '".$CODIGO_USUARIO_ACESSO."'
				 ";
				$rs_grava_busca = mysql_query($sq_grava_busca, $banco00);
				//$mensagem_alterar .= "SQL: ".$sq_grava_busca."".$quebralinha."";		
				
				$mensagem_alterar .= "A Quantidade do item:".$CODCOM." foi ALTERADA para:" .$QUANTIDADE. ".".$quebralinha."";
				$mensagem_status = "true";
				 $mensagem_codigo = 104;	

			 }else{
			 	$mensagem_alterar .= "O item ".$CODCOM." nao foi ENCONTRADO no Orcamento!".$quebralinha."";
			 	$mensagem_status = "false";	
			 	 $mensagem_codigo = 105;	
			 }	
	}else{
		$mensagem_alterar .= "O item ".$CODCOM." esta INCORRETO no Orcamento!".$quebralinha."";
		$mensagem_status = "false";
		 $mensagem_codigo = 106;			
	}

	$mensagem .= $mensagem_alterar;	
	echo "{\"ver\":\"".$mensagem_status."\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"".$mensagem_codigo."\",\"msg\":\"".$mensagem_alterar."\",\"syAcesso\":\"".time()."\"}";
	break;		
	case 'excluir': //# excluir um item

		if(strlen($CODCOM)==13){


			  $sq_busca = "SELECT * FROM TAB_PEDIDO_APLICATIVO_TEMP 
			  WHERE DESCRICAO= '".$CODCOM."' 
			  AND CODUSU = '".$CODIGO_USUARIO_ACESSO."'
			  LIMIT 1
			  ";
				 $rs_busca = mysql_query($sq_busca, $banco00);
				 $to_busca = mysql_num_rows($rs_busca);	
				// $mensagem .= "SQL: ".$sq_busca."".$quebralinha."";	

				 if($to_busca>0){
					$ln_busca = mysql_fetch_array($rs_busca);

					$sq_apagar = "DELETE FROM TAB_PEDIDO_APLICATIVO_TEMP 
					WHERE DESCRICAO = '".$CODCOM."' 
					AND CODUSU = '".$CODIGO_USUARIO_ACESSO."' ";
					$rs_apagar = mysql_query($sq_apagar, $banco00);	
					//$msg_excluir .= "SQL: ".$sq_apagar."".$quebralinha."";
				
					$msg_excluir .= "O item ".$CODCOM.", foi EXCLUIDO com sucesso do Orcamento! ".$quebralinha."";
					$mensagem_status = "true";
					 $mensagem_codigo = 107;		

			}else{
					$msg_excluir .= "O item ".$CODCOM." nao foi encontrado no Orcamento! ".$quebralinha."";
					$mensagem_status = "false";
					 $mensagem_codigo = 108;			
			}

		}else{
				$msg_excluir .= "Digite ITEM para excluir! ".$quebralinha."";
				$mensagem_status = "false";
				 $mensagem_codigo = 109;			
		}

	$mensagem .= $msg_excluir;		
	echo "{\"ver\":\"".$mensagem_status."\",\"usr\":\"".$CODIGO_USUARIO_ACESSO."\",\"cod\":\"".$mensagem_codigo."\",\"msg\":\"".$msg_excluir."\",\"syAcesso\":\"".time()."\"}";
	break;
	
	}
	
}

 // USUARIO


	}else{
		 $mensagem_erro .= "Entre com seu usuario! ".$quebralinha."";
		  $mensagem_codigo = 119; 
		echo "{\"ver\":\"false\",\"cod\":\"".$mensagem_codigo."\",\"msg\":\"".$mensagem_erro."\",\"syAcesso\":\"".time()."\"}";
	} 


//echo "{\"ver\":\"false\",\"msg\":\" ".$mensagem."\",\"syAcesso\":\" ".time()."\"}";

echo"]}";
?> 
