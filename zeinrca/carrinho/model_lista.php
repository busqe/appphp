<?




function fn_lista_selecionar($campo,$valor,$link, $conexao){


 if($campo &&  $valor && $link && $conexao){
		
		$cls_checar = "SELECT * FROM  TAB_PEDIDO_APLICATIVO_CAT WHERE ".$campo." LIKE '".$valor."' AND ESTATUS=0 LIMIT 1";
		$sql_checar = mysql_query($cls_checar, $conexao);
		$tot_checar = mysql_num_rows($sql_checar);	
		
		//echo  $cls_checar . "<br />";
		//echo  "TOTAL = ". $tot_checar . "<br />";
  
		if($tot_checar>0){
				$resultado = mysql_fetch_array($sql_checar);
		}else{
				$resultado = NULL;		
		}
		
		
}else{
		$resultado = NULL;
} 
return $resultado;

}	
	
	
function fn_lista_inserir($usuario, $lista, $conexao){

// selecionar o ultimo inserido	
$mensagem = array();
  

if($usuario && $lista && $conexao){
						
	  $sq1 = "INSERT INTO TAB_PEDIDO_APLICATIVO_CAT(";

					$sq1 = $sq1 . "CODSES, "; 
					$sq1 = $sq1 . "CODUSO, "; 
					$sq1 = $sq1 . "FILIAL, "; 
					$sq1 = $sq1 . "NOMEUSO, "; 
					$sq1 = $sq1 . "EMAILUSO,"; 
					
					$sq1 = $sq1 . "DESCRICAO, "; 
					$sq1 = $sq1 . "ARQUIVO, "; 
					
					$sq1 = $sq1 . "DATACRIA, "; 
					$sq1 = $sq1 . "DATAMOD, "; 
					$sq1 = $sq1 . "DIASEMANA, "; 
					$sq1 = $sq1 . "ESTATUS"; 

					$sq1 = $sq1 . ")VALUES(";

					$sq1 = $sq1 . "'" .md5($lista["DATACRI"]) . "', "; 
					$sq1 = $sq1 . "'" . $usuario["usoCodUso"] . "', "; 
					$sq1 = $sq1 . "'ISSAM''', "; 
					$sq1 = $sq1 . "'" . $usuario["usoNom"] . "', "; 
					$sq1 = $sq1 . "'" . $usuario["usoMail"] . "', "; 
					
					$sq1 = $sq1 . "'" .  $lista["DESCRICAO"] . "', "; 
					$sq1 = $sq1 . "'" . $lista["ARQUIVO"] . "', "; 
					
					$sq1 = $sq1 . "'" . $lista["DATACRI"] .  "', "; 
					$sq1 = $sq1 . "'" . $lista["DATAMOD"] . "', "; 
					$sq1 = $sq1 . "'" . $lista["DIASEMANA"] . "', "; 
					$sq1 = $sq1 . "'0'";
				  
					$sq1 = $sq1 . ")";
					
					$rs_grava = mysql_query($sq1, $conexao) or die(mysql_error($conexao)); 
					

				$mensagem["texto"] = "O Orcamento: ".$max_link["CODLINK"] ."  foi criado com sucesso.";
				$mensagem["codigo"] = 1; 
		
		// echo "TESTE: " . $sq1 ."  <br /><br />";

}else{
	$mensagem["texto"] = "Ops... Nao foi possivel criar o Orcamento!";
	$mensagem["codigo"] = 0; 
 }

 /// echo $sq1 ."  <br /><br />";
 
  return $mensagem;
}
	
	
function fn_lista_finalizar($dados_lista, $usuario, $totalitens, $conexao){
 
if($dados_lista && $usuario &&  $conexao){

		
			$sq_grava = "UPDATE TAB_PEDIDO_APLICATIVO_CAT SET 
			TOTALITENS=".$totalitens.",
			DATAMOD='".$dados_lista["DATAMOD"]."',  
			ESTATUS=1  
			WHERE CODUSO=".$usuario." AND CODLINK=".$dados_lista["CODLINK"]."";
			$rs_grava_busca = mysql_query($sq_grava, $conexao);

			//echo $sq_grava . "<br />";

			$resultado[1] = 1;
			$resultado[2] = "Orcamento finalzado com sucesso!";

	}else{
			$resultado[1] = 0;
			$resultado[2] = "ERRO! Nao foi possivel finalizar Orcamento!";
	}
	
return $resultado;
}

?>