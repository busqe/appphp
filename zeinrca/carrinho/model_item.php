<?
// fn_item_selecionar
// fn_atualizar_item
// fn_excluir_item


function fn_item_selecionar($campo, $valor, $link, $conexao){


if($link && $campo &&  $valor && $conexao){
		$cls_checar = "SELECT * FROM  TAB_PEDIDO_APLICATIVO WHERE ".$campo." LIKE '".$valor."' AND  CODLINK=".$link." LIMIT 1";
		$sql_checar = mysql_query($cls_checar, $conexao) or die(mysql_error($conexao));
		$tot_checar = mysql_num_rows($sql_checar);	
		 //echo("TESTE ITEM =  ".$cls_checar." <br /> <br />");
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
	
	
function fn_item_inserir($linha, $codlink, $usuario, $conexao){

 
if($linha && $codlink && $conexao){
						
	  $sq1 = "INSERT INTO TAB_PEDIDO_APLICATIVO(";

					$sq1 = $sq1 . "QUANTIDADE, "; 

					$sq1 = $sq1 . "CODLINK, "; 
					$sq1 = $sq1 . "CODUSO, "; 
					$sq1 = $sq1 . "CODCOM, "; 
					$sq1 = $sq1 . "DESCRICAO, "; 
					$sq1 = $sq1 . "CODBAR, "; 

					$sq1 = $sq1 . "CODFORN, "; 
					$sq1 = $sq1 . "FABRICANTE, "; 
					
					$sq1 = $sq1 . "CAIXA, "; 
					$sq1 = $sq1 . "GRUPO, "; 
					
					$sq1 = $sq1 . "DIMENPC, "; 
					$sq1 = $sq1 . "DIMENCX, "; 
					$sq1 = $sq1 . "PESO_GW, "; 
					$sq1 = $sq1 . "PESO_NW, "; 

					$sq1 = $sq1 . "ORIGEM, "; 
					$sq1 = $sq1 . "REFERENCIA, "; 
					$sq1 = $sq1 . "CUBIC, "; 
					
					$sq1 = $sq1 . "ESTATUS"; 

					$sq1 = $sq1 . ")VALUES(";

					$sq1 = $sq1 . "'" . $linha["QUANTIDADE"] . "',"; 
					$sq1 = $sq1 . "" . $codlink . ","; 
					$sq1 = $sq1 . "'" . $usuario . "',"; 
					$sq1 = $sq1 . "'" . $linha["CODCOM"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["DESCRICAO"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["CODBAR"] . "', "; 
					$sq1 = $sq1 . "" .  $linha["CODFORN"] . ", "; 
					$sq1 = $sq1 . "'" . $linha["FABRICANTE"] . "', "; 
					
					$sq1 = $sq1 . "" . $linha["CAIXA"] .  ", "; 
					$sq1 = $sq1 . "" . $linha["GRUPO"] . ", "; 
					
					$sq1 = $sq1 . "'" . $linha["DIMENPC"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["DIMENCX"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["PESO_GW"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["PESO_NW"] . "', "; 
					
					$sq1 = $sq1 . "'" . $linha["ORIGEM"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["REFERENCIA"] . "', "; 
					$sq1 = $sq1 . "'" . $linha["CUBIC"] . "',";
			 
					$sq1 = $sq1 . "0";
					$sq1 = $sq1 . ")";
					
					$rs_grava = mysql_query($sq1, $conexao) or die(mysql_error($conexao)); 
				  // echo $sq1 ."  <br /><br />";
					
					$sq1 = "";
					
 		 return "O Item: ".$linha["CODCOM"] ."  foi gravado com sucesso!"; 

}else{
	return "Ops! Nao foi possivel gravado o item ".$linha["CODCOM"] ."!";
 }

}


function fn_item_excluir($codigo,$link, $conexao){
	    $mensagem .= "Excluindo item ".$codigo." da lista ".$link."... <br />";
		
		if($conexao && $codigo && $link ){
			$mensagem .= "Selecionando item... <br />";
			$sql_checar = mysql_query("SELECT * FROM  TAB_PEDIDO_APLICATIVO WHERE CODCOM=".$codigo." AND CODLINK=".$link." LIMIT 1", $conexao);
			$tot_checar = mysql_num_rows($sql_checar);	
				if($tot_checar > 0){
					$sql_apagar = "DELETE FROM TAB_PEDIDO_APLICATIVO WHERE CODCOM='".$codigo."' AND CODLINK=".$link."";
					$rse_apagar = mysql_query($sql_apagar, $conexao);
					$mensagem .= "O item foi excluido com sucesso. <br />"  ; 	
				}else{
					$mensagem .= "O Item nao foi encontrado! <br />"; 
				}
		 }else{
			$mensagem .=  "Nao foi possivel conectar a um dos bancos! <br />";
		 }
  return $mensagem;
}
?>

