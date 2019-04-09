<? 
$mensagem = "<br /><br />Mensagens de usuario: <br />";
include"../../../../config/conexao/iss_connect.php"; 


if($banco02){

    $codigo = $_GET["usuario_codigo"];
    $acao_acesso = $_GET["usuario_acao"];

    if($codigo<1){ $codigo = $_POST["usuario_codigo"];}
    if(strlen($acao_acesso)<1){ $acao_acesso = $_POST["usuario_acao"];}
    //if(!$acao_acesso ){$acao_acesso ="exibir";}


	if($codigo>0){	


		if($acao_acesso=="exibir"){

			$mensagem .=  "Conectando... <br />";

		 	$sq_us = mysql_query("SELECT 
		 		usoCodUso as usId, 
		 		usoNom as usNome, 
		 		usoMail as usEmail,
		 		usoPas as usSenha
		 		FROM  tab_colaborador WHERE usoCodUso = '".$codigo."' LIMIT 1", $banco02);

				$mensagem .=  "Selecionando usuario... <br />";

		 		if(mysql_num_rows($sq_us) > 0)
				{
				   $linha = mysql_fetch_array($sq_us);
				  
				   $mensagem .=  "Listado usuario... <br />";

				   	$usuario_dados = array();
				    $usuario_dados["syMsg"] = "true"; 
				    $usuario_dados["usCod"] = $linha['usId']; 
					$usuario_dados["usNome"] = $linha['usNome']; 
					$usuario_dados["usEmail"] = $linha['usEmail']; 
					$usuario_dados["usSenha"] = $linha['usSenha']; 
					$usuario_dados["syAcesso"] = "".time().""; 
					//$usuario_dados = $linha['usoSetor']; 
					//$usuario_dados = $linha['usoNivel']; 
					//$usuario_dados = $setCod;

				 
				  	$JSON_USUARIO_ATUAL = json_encode($usuario_dados ); 
				    echo $JSON_USUARIO_ATUAL . "";

					 //$mensagem .=  "filtrando setor... <br />";
				    $setCod = $linha['usoSetor']; 
					$usoCodUso = $linha['usoCodUso']; 
					$usoNom = $linha['usoNom']; 
					$usoMail = $linha['usoMail']; 
					$usoPas= $linha['usoPas']; 
					$usoSetor = $linha['usoSetor']; 
					$usoNivel = $linha['usoNivel']; 
					$setNom = $setCod;
					
					$ONLINE_USR = 1;
					$TIPO_NAVEGACAO = 1;
					
					$mensagem .=  "Criando sessao...<br />";
					setcookie("issamadm", "&".$usoCodUso."&".$TIPO_NAVEGACAO."&".$ONLINE_USR."&", time()+(3600*24*30*12),"/",$servidor_atual); 

					$mensagem .=  "Bem-Vindo: $usoNom <br />";
			
			
				}else{ // usuario

				  $mensagem .=  "Usuario nao encontrado! <br />";
				  echo "{\"syMsg\":\"false\",\"mensagem\":\"Usuario nao encontrado!\" ,\"syAcesso\":\"1516884933\"}";
				}

		}else{ // usuario
			$mensagem .=  "Selecione uma acao!<br />";
			echo "{\"syMsg\":\"false\",\"mensagem\":\"Selecione uma acao!\" ,\"syAcesso\":\"1516884933\"}";
		}
 
	}else{ // usuario
		$mensagem .=  "Selecione um usuario!<br />";
		echo "{\"syMsg\":\"false\",\"mensagem\":\"Selecione uma acao!\" ,\"syAcesso\":\"1516884933\"}";
	}

}else{ // conexao
	$mensagem .=  "Erro ao conectar!<br />";
	echo "{\"syMsg\":\"false\",\"mensagem\":\"Erro ao conectar!\" ,\"syAcesso\":\"1516884933\"}";
}


if($_GET["s"]==1){

 
echo($mensagem . "");
//echo $praonde;
}	

?>