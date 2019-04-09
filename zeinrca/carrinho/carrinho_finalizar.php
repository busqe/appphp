<?

include"../../../config/conexao/iss_connect.php"; 
include "model_usuario.php";
include "model_produto_todos.php";
include "model_lista.php";
include "model_item.php";

$banco02 = FN_conexao_banco(2); // USUARIO
$banco01 = FN_conexao_banco(5); // PRODUTOS
$banco00 = fn_conexao_banco(555); // ORCAMENTO

$quebralinha = "\n";
echo"{\"android\": [\n";  // { "android": [

//------------------------------ SELECIONAR TEMP -------------------------------------


$mensagem = "".$quebralinha."".$quebralinha."Mensagens do Orcamento: ".$quebralinha."";

$CODIGO_USUARIO_ACESSO = $_GET["us"];
if($CODIGO_USUARIO_ACESSO > 0){

	$sq_pedido = "SELECT * FROM TAB_PEDIDO_APLICATIVO_TEMP WHERE CODUSU=".$CODIGO_USUARIO_ACESSO." ORDER BY DESCRICAO ASC LIMIT 500  ";
	$rs_pedido = mysql_query($sq_pedido, $banco00);
	$to_pedido = mysql_num_rows($rs_pedido);
		
	if($to_pedido > 0)
	{

	//------------------------------ GRAVAR LISTA -------------------------------------
	
	// criar LISTA
	 $data_codigo    = date("Ymdhis"); 
	 $lista_campo    = "CODUSO";
	 $lista_linkc    = 1;
	
	 $msg_lista 	 =  "Abrindo Orcamento. ".$quebralinha."" ;
	

			if(strlen($CODIGO_USUARIO_ACESSO)>0){
			
				$msg_lista .=  "Conferindo Orcamento do usuario: " . $CODIGO_USUARIO_ACESSO.". ".$quebralinha."";
				$dados_lista = fn_lista_selecionar($lista_campo, $CODIGO_USUARIO_ACESSO, $lista_linkc, $banco00);
				
				if($dados_lista == NULL){
				
					$linha_lista = array();
					$linha_lista["DESCRICAO"] = "ORCAMENTO_APP";
					$linha_lista["ARQUIVO"] = "TAB_PEDIDO_APLICATIVO_TEMP";
					$linha_lista["DATACRI"] = date("Y-m-d");
					$linha_lista["DATAMOD"] = $linha_lista["DATACRI"];
					$linha_lista["DIASEMANA"] = date("l");
					
					$linha_usuario = fn_usuario_selecionar($CODIGO_USUARIO_ACESSO, $banco00);
					$msg_inserir = fn_lista_inserir($linha_usuario, $linha_lista, $banco00);
				
					$msg_lista .=  "Criando Orcamento:  ".$msg_inserir["texto"]." ".$quebralinha."";
				
					if($msg_inserir["codigo"]==1){
						$dados_lista = fn_lista_selecionar($lista_campo, $CODIGO_USUARIO_ACESSO, $lista_linkc, $banco00);
						    if($dados_lista == NULL){
							  $msg_lista .= "ERRO: Erro ao criar Orcamento!".$quebralinha."";
						    }else{
							  $msg_lista .= "Orcamento ".$dados_lista["CODLINK"]." criado com sucesso!".$quebralinha."";
						    }
					}else{
						$dados_lista = NULL;
						$msg_lista .= "Ops! Algo deu errado, tente novamente!".$quebralinha."";
					}
				}else{
					$msg_lista .=  "Selecionando Orcamento codigo: ".$dados_lista["CODLINK"].".".$quebralinha."";
				}
		    }else{
		  	 	$msg_lista =  "ERRO: Orcamento nao encontrado!".$quebralinha.""; 
		  	 	echo "{\"ver\":\"false\",\"msg\":\"".$msg_lista."\",\"syAcesso\":\"".time()."\"}";
		    }	
		
			$mensagem .= $msg_lista;							
			//echo("MENSAGEM GERAL: ". $mensagem . "".$quebralinha."");
			//exit();


			//------------------------------ GRAVAR ITENS -------------------------------------

			if($dados_lista["CODUSO"]>0){					 
				if($dados_lista["CODLINK"]>0){

					$codigo_link_atual = $dados_lista["CODLINK"]; 
					$msg_item .=  "Gravando: ".$to_pedido." itens no Orcamento codigo: " . $dados_lista["CODLINK"]."  ".$quebralinha.""; 
			 
					while($linha = mysql_fetch_array($rs_pedido)){
					 
						// confere o item
						$campo_item   = "CODCOM";
						$codigo_item	 = $linha["DESCRICAO"];
						$codigo_link      = $dados_lista["CODLINK"];
						
						if(strlen($codigo_item)==13){
							$msg_item .=  "Checando...  " . $codigo_item." ".$quebralinha."";
							//$msg_item = fn_item_excluir($codigo_item,$codigo_link);
							$confere_item = fn_item_selecionar($campo_item, $codigo_item, $codigo_link, $banco00);
								
							if($confere_item == NULL){
								$msg_item .=  "Selecionando...  ".$confere_item["DESCRICAO"]."".$quebralinha."";
								$dados_produtos = FN_selecionar_produto_todos("CODCOM", $codigo_item, $banco01);
								
									if($dados_produtos != NULL){

										// carrega quantidade
										$dados_produtos["QUANTIDADE"]=$linha["TOTALITENS"];

										$msg_grava = fn_item_inserir($dados_produtos, $codigo_link, $CODIGO_USUARIO_ACESSO, $banco00);
										$msg_item .=  $msg_grava . "".$quebralinha.""; 
										$msg_item .=  "Item gravado com sucesso... ".$quebralinha.""; 
									}else{
										$msg_item .=  "ERRO: Item nao encontrado!".$quebralinha.""; 
									}
							}else{
							 	
								$msg_item .=  "ERRO: Ja existe, nao foi gravado! ".$quebralinha.""; 
							}
						}else{
								$msg_item .=  "ERRO: Codigo incorreto! ".$quebralinha.""; 
						}		
						//echo $msg_item . "".$quebralinha."";	
					} //while

				}else{
					$msg_item  .= "ERRO: Erro ao criar Orcamento".$quebralinha.""; 
				}
			}else{
				$msg_item .=  "ERRO: Usuario nao encontrado".$quebralinha.""; 
				echo "{\"ver\":\"false\",\"msg\":\"".$msg_item."\",\"syAcesso\":\"".time()."\"}";
			}	
			$mensagem .= $msg_item;
			$mensagem .= "Finalizando Orcamento codigo: ".$codigo_link_atual." ".$quebralinha." ";

		  	//------------------------------ final GRAVAR ITENS -------------------------------------	
			
			//echo("MENSAGEM ITEM: ". $mensagem . "".$quebralinha."");

			//exit();
				//------------------------------ inicio FINALIZAR LISTA -------------------------------------


			if($dados_lista["CODLINK"]>0 && $dados_lista["CODUSO"]>0){

				$msg_final = fn_lista_finalizar($dados_lista, $CODIGO_USUARIO_ACESSO, $to_pedido, $banco00);
				
				if($msg_final[1]==1){
					
					$sq_apaga = "DELETE FROM TAB_PEDIDO_APLICATIVO_TEMP WHERE CODUSU='".$CODIGO_USUARIO_ACESSO."' ";
					$rs_apaga = mysql_query($sq_apaga, $banco00) or die (mysql_error($banco00)) ;
					
					$msg_final = "Orcamento finalizado com sucesso!";
					echo "{\"ver\":\"true\",\"msg\":\"".$msg_final."\",\"syAcesso\":\"".time()."\"}";	

				}else{
					$msg_final = "ERRO: Nao foi possivel fianlizar o Orcamento!"; 
					echo "{\"ver\":\"false\",\"msg\":\" ".$msg_final."\",\"syAcesso\":\"".time()."\"}";	
				}
			}else{
				  $msg_final = "ERRO: Nao foi possivel apagar os itens!"; 
				  echo "{\"ver\":\"false\",\"msg\":\"".$msg_final."\",\"syAcesso\":\"".time()."\"}";	
			}

			//------------------------------ final FINALIZAR LISTA -------------------------------------	

	}else{
		 $msg_final .= "ERRO: Selecione um Orcamento para finalizar!";
		 echo "{\"ver\":\"false\",\"msg\":\" ".$msg_final."\",\"syAcesso\":\" ".time()."\"}";
	}
}else{
	 $msg_final .= "ERRO: Selecione um Orcamento para finalizar!";
	 echo "{\"ver\":\"false\",\"msg\":\" ".$msg_final."\",\"syAcesso\":\" ".time()."\"}";
}


 $mensagem .= $msg_final;

//echo("MENSAGEM GERAL: ". $mensagem . "".$quebralinha."");

echo "\n]}";

?> 
             
