<?

function FN_selecionar_produto_todos($campo, $valor, $conexao){

if($campo &&  $valor && $conexao){
		$cls_checar = "SELECT * FROM  A01_LICENCIADO WHERE ".$campo." LIKE '".$valor."' LIMIT 1";
		$sql_checar = mysql_query($cls_checar, $conexao);
		$tot_checar = mysql_num_rows($sql_checar);	
		// echo("TESTE =   ".$cls_checar." <br /> <br />");
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

?>
