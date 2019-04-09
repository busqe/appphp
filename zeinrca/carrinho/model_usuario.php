<?
function fn_usuario_selecionar($codigo, $conexao){

		$sq_usuario = "SELECT * FROM  tab_usuario WHERE usoCodUso='".$codigo."' LIMIT 1"; 
		$rs_usuario = mysql_query($sq_usuario, $conexao) or die(mysql_error($conexao));  // 
		$to_total = mysql_num_rows($rs_usuario);
		
		if($to_total > 0)
		{
	
		    $mensagem .= "Usuario conectado! <br />";
		  
  		    $linha_usuario = mysql_fetch_array($rs_usuario);
 
			$CODIGO_USUARIO_ACESSO		 =  $linha_usuario['usoCodUso'];
			$EMAIL_USUARIO_ACESSO 		 =  $linha_usuario['usoMail'];
			$SENHA_USUARIO_ACESSO 		 =  $linha_usuario['usoPas'];
			$NIVEL_USUARIO_ACESSO 		 =  $linha_usuario['usoNivel'];
			$SETOR_USUARIO_ACESSO 		 =  $linha_usuario['usoSetor'];
			$NOME_USUARIO_ACESSO 		 =  $linha_usuario['usoNom'];
			$SETORNOME_USUARIO_ACESSO    =  $linha_usuario['usoSetorNome'];

		}else{
			 $mensagem .= "Usuario nao encontrado! <br />"; 
			 $linha_usuario = NULL;	
		}	


	return $linha_usuario;
}

?>