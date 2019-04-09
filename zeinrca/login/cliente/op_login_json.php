<? 
$mensagem = "Mensagens de entrada: <br />";
include"../../../../config/conexao/iss_connect.php"; 

$PAGINA_CODIGO = "15";


if($_GET["modo"]=="passaporte" && strlen($_GET["us"])>0){
	
			$codigo_us = $_GET["us"];

			 $mensagem .= "Acessando como administrador...<br />";
			 $mensagem .=  "Selecionando usuario...<br />";		
			 		
			 $rs_entrar = mysql_query("SELECT * FROM  tab_colaborador WHERE usoCodUso=".$codigo_us." LIMIT 1", $banco02);
			 if(mysql_num_rows($rs_entrar)>0)
			 {
					 $linha_us = mysql_fetch_array($rs_entrar);
					 $login_mail =			$linha_us[usoMail];
					 $login_passw =			$linha_us[usoPas];
					
					$mensagem .="Entrando como ". $login_mail."<br />";
					
			 }else{
					$mensagem .="Usuario nao encontrado!<br />";
			 }

	
}else{
	
	$mensagem .= "Usuario digitou os dados <br />";
	
	$login_mail =			$_POST["login_mail"] .""; 
	$login_mail = str_replace('@zein.com.br','', $login_mail);
	$login_mail =			$login_mail."@zein.com.br"; 
	$login_passw =		$_POST["login_passw"];

}


 //exit( $login_mail  . " - " . $login_passw);
 //setcookie("issamadm", "sairsessao", time()-3600,"www.w7s8l0f34rf.com");
 if(isset($_COOKIE["issamadm"])){
	
	 $mensagem .= "Excluindo cookie... <br />";
  	 unset($_COOKIE["issamadm"]);
	 setcookie("issamadm", '', time() - 3600);
		//sleep(2);
		if(isset($_COOKIE["issamadm"])){
			$mensagem .= "Nao foi possivel excluir o cookie... <br />";
		}else{
			$mensagem .= "Cookie excluido! <br />";
		}
		
  }

//$appb_tentativas = isset($_SESSION["appb_tentativas"]) ? (++$_SESSION["appb_tentativas"]) : ($_SESSION["appb_tentativas"] = 1);
//("usuario:" . $login_mail . "senha:" . $login_passw );


$dia_da_semana = array("Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
$num_dia = date(w);
$dia_extenso = $dia_da_semana[$num_dia];
$data_reg = date("y/m/d");			
$hora_reg = date("H:i:s");
$end_ip_reg = getenv("REMOTE_ADDR"); 

 // tenta conectar

if($banco02){

$acao_acesso = $_GET["action"];
if(!$acao_acesso ){$acao_acesso ="entrar";}

if($acao_acesso=="entrar"){

	if(strlen($login_mail)<10 || strlen($login_passw)<5){ 
 		$praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../login/?msg=error'>";
		

		$mensagem .=  "Dados incorretos! <br />";
	} else{
		$mensagem .=  "Carregando...  <br />";
	}



	$mensagem .=  "Conectado... <br />";
 	$sq_us = mysql_query("SELECT 
 		usoCodUso as usId, 
 		usoNom as usNome, 
 		usoMail as usEmail,
 		usoPas as usSenha
 		  FROM  tab_colaborador WHERE usoMail = '".$login_mail."' AND usoPas = '".$login_passw."' AND usoPub = 1 LIMIT 1", $banco02);

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
			


			/*
			$sqST= mysql_query("SELECT setSigla FROM tab_setores WHERE setCod = ".$setCod." AND setPub=1", $banco02);
			$linhaST = mysql_fetch_array($sqST) or die(mysql_error($banco02));
			
			if(mysql_num_rows($sqST) == 1)
			{
				$codigo_setor = $linhaST['setSigla']; 
			}
			else
			{
				$codigo_setor = "NY";
			}
 		*/
			 //$mensagem .=  "filtrando setor... <br />";
		    $setCod = $linha['usoSetor']; 
			$usoCodUso = $linha['usoCodUso']; 
			$usoNom = $linha['usoNom']; 
			$usoMail = $linha['usoMail']; 
			$usoPas= $linha['usoPas']; 
			$usoSetor = $linha['usoSetor']; 
			$usoNivel = $linha['usoNivel']; 
			$setNom = $setCod;
 
			$CODIGO_USUARIO_ACESSO =  $usoCodUso;
			$EMAIL_USUARIO_ACESSO =  $usoMail;
			$SENHA_USUARIO_ACESSO =  $usoPas;
			$NIVEL_USUARIO_ACESSO =  $usoNivel;
			$SETOR_USUARIO_ACESSO =  $usoSetor;
			$NOME_USUARIO_ACESSO =  $usoNom; 
			$SETORNOME_USUARIO_ACESSO =  $setNom;
		
			$sqB = "UPDATE tab_colaborador  SET usuOnline=1 WHERE usoCodUso = ".$usoCodUso." ";  
			$sqlG = mysql_query($sqB,$banco02);	
			
			$mensagem .=  "Entrando online... <br />";
			
			
			$mensagem .=  "Registrando acesso... <br />";
			$ONLINE_USR = 1;
			$TIPO_NAVEGACAO = 1;
			
			$mensagem .=  "Criando sessao...<br />";
			setcookie("issamadm", "&".$usoCodUso."&".$TIPO_NAVEGACAO."&".$ONLINE_USR."&", time()+(3600*24*30*12),"/",$servidor_atual); 
			//setcookie("issamadm", "&".$usoCodUso."&".$usoMail."&".$usoPas."&".$usoNivel."&".$usoSetor."&".$usoNom."&".$setNom."&".$TIPO_NAVEGACAO."&".$ONLINE_USR."&", time()+(3600*24*30*12),"/",$servidor_atual); 


			$mensagem .=  "Bem-Vindo: $usoNom <br />";
			
			switch($SETOR_USUARIO_ACESSO){
				case 1:
						$praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../../appm/start/?msg=online&on=".$ONLINE_USR."'>";
				break;
				case 3:
					$praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../../appu/start/?msg=online&on=".$ONLINE_USR."'>";
				break;
				case 20:
					$praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../../appk/start/?msg=online&on=".$ONLINE_USR."'>";
				break;				
				default:
						$praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../../appm/start/?msg=online&on=".$ONLINE_USR."'>";
				break;
				
			
			} 
	
			
			$sqD = "INSERT INTO tab_login_usuario (logRepCod, logRepDiaReg, logRepDatReg, logRepHorReg, logRepIpReg, logRepNome, logRepSetor)
			VALUES  ('".$usoCodUso."','".$dia_extenso."', '".$data_reg."','".$hora_reg."', '".$end_ip_reg."', '".$usoNom."', ".$usoSetor.")"; 
			$sqlE = mysql_query($sqD,$banco02);	
	
		}else{

	   		$usuario_dados = array();
		    $usuario_dados["syMsg"] = "false"; // nao encontrado
			$usuario_dados["syAcesso"] = "".time().""; 
			//$usuario_dados = $linha['usoSetor']; 
			//$usuario_dados = $linha['usoNivel']; 
			//$usuario_dados = $setCod;
		 
		  	$JSON_USUARIO_ATUAL = json_encode($usuario_dados ); 
		    echo $JSON_USUARIO_ATUAL . "";			
			
				  $mensagem .=  "Dados incorretos!<br />";
 					
						 //unset($_SESSION['uso_login_session']);
						 //unset($_SESSION['uso_senha_session']);
				
 					if ($appb_tentativas < 5)
					{
						$mensagem .=  "Dados incorretos! Tente novamente.<br />";
 						 $praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../login/?msg=try'>";

					}else{
 						 $praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../login/?msg=max'>";

						$mensagem .=  "Tentativas demais. Entre mais tarde!<br />";
 					}
						
		  
		}



} // action	


if($acao_acesso=="sair"){
			// $mensagem .=  "Conectando...<br />";			
			$usuario_id = $_GET["us"];
			if(strlen($usuario_id)>1){
				
				     $mensagem .=  "Selecionando Usuario...<br />";				
					 $sq_usuario = mysql_query("SELECT * FROM  tab_colaborador WHERE usoCodUso=".$usuario_id." LIMIT 1", $banco02);
					 if(mysql_num_rows($sq_usuario)>0)
					 {
							 $sq_sair = "UPDATE tab_colaborador  SET usuOnline=0 WHERE usoCodUso=".$usuario_id."";  
							 $rs_sair = mysql_query($sq_sair,$banco02);	
							$mensagem .=  "Saindo...<br />";
							 $praonde="<META HTTP-EQUIV=REFRESH CONTENT= '3;URL=../login/?msg=exit'>";

							
					 }else{
							$praonde="Usuario nao encontrado!<br />";
					 }
			
			}else{
				$mensagem .=  "Selecione um usuario<br />";
		    }		 

	 unset($_COOKIE["issamadm"]);
 	 setcookie("issamadm", "sairsessao", time()-3600,"www.w7s8l0f34rf.com");
 	// header( 'Location:  ../login/?msg=SAIU_NAO_IDENTIFICADO') ;
	 $praonde="<META HTTP-EQUIV=REFRESH CONTENT= '3;URL=../login/?msg=exit'>";


} // sair	

 
}else{
	$mensagem_01 =  "Erro ao conectar...<br />";
	 $praonde="<META HTTP-EQUIV=REFRESH CONTENT= '0;URL=../login/?msg=error'>";

}

if($_GET["s"]==1){

// {"error":false,"uid":"5a18cf8590fbc9.83252973","user":{"name":"teste","email":"teste@teste.com","created_at":"2017-11-25 00:03:49","updated_at":null}}

echo($mensagem . "");
//echo $praonde;
}	

?>